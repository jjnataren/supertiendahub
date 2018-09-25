<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use common\models\KeyStorageItem;
use Yii;

class ArticuloPrestashopQuantityFromHubController extends \yii\web\Controller
{
    /**
     * @return string
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    public function actionIndex()
    {
        $quantities = $this->getQuantity();

        $articles = Articulo::find()->all();
        $response = array();


        foreach ($articles as $article) {

            $articlePrestashop = ArticuloPrestashop::find()->where(['sku' => $article->sku])->one();

            if ($articlePrestashop !== null && isset($quantities[$articlePrestashop->id_prestashop]['quantity'])
                && (int)$article->existencia_ps !== (int)$quantities[$articlePrestashop->id_prestashop]['quantity']) {
                $result = array(
                    'id_prestashop' => $articlePrestashop->id_prestashop,
                    'reference' => $articlePrestashop->sku,
                    'quantity' => (int)$article->existencia_ps,
                    'quantity_ps' => (int)$quantities[$articlePrestashop->id_prestashop]['quantity'],
                    'id_stock' => (string)$quantities[$articlePrestashop->id_prestashop]['id']
                );
                $response[] = $result;
            }

        }


        return $this->render('index', ['result' => $response]);
    }

    public function actionExport()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $tochannge = Yii::$app->getRequest()->getBodyParams();

        $this->editStock($tochannge['id_stock'], $tochannge['quantity']);

        return $tochannge;
    }

    public function actionExportAll()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $articles = Yii::$app->getRequest()->getBodyParams();

        foreach ($articles as $article) {
            $this->editStock($article['id_stock'], $article['quantity']);
        }

        return $articles;
    }

    /**
     * @param $xml
     * @param $quantity
     * @return string
     * @throws PrestaShopWebserviceException
     */
    private function editStock($stockId, $quantity)
    {
        $xml = $this->obtenerSchemaUpdateStock($stockId);
        $xml->stock_available->quantity = $quantity;
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $stockId;
        $opt['putXml'] = $xml->asXML();

        $this->getClient()->edit($opt);
    }

    /**
     * @param $id
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    private function obtenerSchemaUpdateStock($id)
    {
        $client = $this->getClient();
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $id;
        return $client->get($opt);
    }

    /**
     * @param $id_product
     * @return array
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    private function getQuantity()
    {
        $client = $this->getClient();

        $xml = $client->get(['resource' => 'stock_availables',
            'display' => '[quantity,id_product,id]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
        ['stock_availables']['stock_available'];

        $responses = array();

        foreach ($items as $item) {
            $responses[(string)$item['id_product']] = $item;
        }

        return $responses;
    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }
}
