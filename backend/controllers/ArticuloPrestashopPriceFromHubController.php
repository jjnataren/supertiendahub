<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use common\models\KeyStorageItem;
use Yii;

class ArticuloPrestashopPriceFromHubController extends \yii\web\Controller
{
    /**
     * @return string
     * @throws \backend\models\client\PrestaShopWebserviceException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {

        $client = $this->getClient();
        $dollarPrice = $this->getParidad();
        $formatter = Yii::$app->formatter;

        $xml = $client->get(['resource' => 'products',
            'display' => '[id,reference,price]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
        ['products']['product'];

        $results = array();

        foreach ($items as $item) {
            $articlePrestashop = ArticuloPrestashop::find()->where(['id_prestashop' => $item['id']])->one();
            $article = Articulo::find()->where(['sku' => $item['reference']])->one();

            if ($articlePrestashop !== null && $article !== null) {
                if ($article->moneda === 'MN') {
                    $precio = $article->precio;
                } else {
                    $precio = $article->precio * (double)$dollarPrice;
                }

                if ($article->tipo_utilidad_ps === 1) {
                    $utilidad = $article->utilidad_ps + 1;
                    $precio *= $utilidad;
                } else {
                    $utilidad = $article->utilidad_ps;
                    $precio += $utilidad;
                }

                $precio = round($precio, 2, PHP_ROUND_HALF_UP);
                $precio_prestashop = round((float)$item['price'], 2, PHP_ROUND_HALF_UP);

                if (number_format($precio_prestashop, 2) !== number_format($articlePrestashop->precio, 2)) {
                    $result = array(
                        'id_prestashop' => $item['id'],
                        'reference' => $item['reference'],
                        'price' => '$' . $formatter->asCurrency($item['price'], 'MXN'),
                        'price_hub' => '$' . $formatter->asCurrency($articlePrestashop->precio, 'MXN'),
                        'tipo_cambio' => 'Diferencia Prestashop HUB - Prestashop Online'
                    );

                    $results[] = $result;
                } else if (number_format($article->precio, 2) !== number_format($articlePrestashop->precio_original, 2)) {
                    $result = array(
                        'id_prestashop' => $item['id'],
                        'reference' => $item['reference'],
                        'price' => '$' . $formatter->asCurrency($item['price'], 'MXN'),
                        'price_hub' => '$' . $formatter->asCurrency($articlePrestashop->precio, 'MXN'),
                        'tipo_cambio' => 'Diferencia PCH - Prestashop HUB'
                    );

                    $results[] = $result;
                } else if (number_format($precio, 2) !== number_format($articlePrestashop->precio, 2)) {
                    $result = array(
                        'id_prestashop' => $item['id'],
                        'reference' => $item['reference'],
                        'price' => '$' . $formatter->asCurrency($item['price'], 'MXN'),
                        'price_hub' => '$' . $formatter->asCurrency($articlePrestashop->precio, 'MXN'),
                        'tipo_cambio' => 'Diferencia PCH - Prestashop Online'
                    );

                    $results[] = $result;
                }
            }

        }

        return $this->render('index', ['result' => $results]);
    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }

    private function getParidad()
    {
        $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
        $soapClient = new \SoapClient($wsdl);
        return $soapClient->ObtenerParidad('50527', '487478')->datos;
    }

    /**
     * @return array|Articulo|null|\yii\db\ActiveRecord
     * @throws \yii\base\InvalidConfigException
     * @throws PrestaShopWebserviceException
     */
    public function actionExport()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $tochannge = Yii::$app->getRequest()->getBodyParams();

        $article = Articulo::find()->where(['sku' => $tochannge['reference']])->one();
        $this->savePrice($article);
        return $article;
    }

    /**
     * @param $article
     * @throws PrestaShopWebserviceException
     */
    private function savePrice($article)
    {
        if ($article->moneda === 'MN') {
            $precio = $article->precio;
        } else {
            $precio = $article->precio * (double)$this->getParidad();
        }

        if ($article->tipo_utilidad_ps === 1) {
            $utilidad = $article->utilidad_ps + 1;
            $precio *= $utilidad;
        } else {
            $utilidad = $article->utilidad_ps;
            $precio += $utilidad;
        }

        $precio = round($precio, 2, PHP_ROUND_HALF_UP);

        $articuloPrestashop = ArticuloPrestashop::find()->where(['sku' => $article->sku])->one();

        $opt = array('resource' => 'products');
        $opt['id'] = $articuloPrestashop->id_prestashop;

        $xml = $this->getClient()->get($opt);
        $children = $xml->children()->children();
        unset($children->manufacturer_name, $children->quantity);

        $children->price = $precio;
        $articuloPrestashop->precio = $precio;
        $articuloPrestashop->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);

        $opt = array('resource' => 'products');
        $opt['putXml'] = $xml->asXML();
        $opt['id'] = $articuloPrestashop->id_prestashop;

        try {
            $this->getClient()->edit($opt);
        } catch (PrestaShopWebserviceException $e) {
        }

        $articuloPrestashop->save();
    }

    /**
     * @return array
     * @throws PrestaShopWebserviceException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionExportAll()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $articles = Yii::$app->getRequest()->getBodyParams();

        foreach ($articles as $article) {
            $articulo = Articulo::find()->where(['sku' => $article['reference']])->one();
            $this->savePrice($articulo);
        }

        return $articles;
    }

}
