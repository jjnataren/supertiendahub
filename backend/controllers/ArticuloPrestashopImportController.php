<?php
/**
 * Created by PhpStorm.
 * User: bestevez
 * Date: 16/10/2018
 * Time: 08:20 PM
 */

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\TipoCambio;
use common\models\KeyStorageItem;
use Yii;
use yii\web\Controller;

class ArticuloPrestashopImportController extends Controller
{

    /**
     * @throws PrestaShopWebserviceException
     */
    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $items = $this->getProductsFromPrestashop();
        $quantities = $this->getQuantity();

        foreach ($items as $item) {
            $article = Articulo::find()->where(['sku' => $item['reference']])->one();
            if ($article !== null) {
                $from_pch = $this->getArticleBySku($article->sku);

                if ($from_pch !== null) {
                    $price_pch = $this->getPrecioUtilidad($article, (float)$from_pch->precio);
                    $price_prestashop = (float)$item['price'];

                    if (number_format($price_prestashop, 2) !== number_format($price_pch, 2)) {
                        try {
                            $this->editPrice($article, $item['id'], $price_prestashop, $price_pch);
                        } catch (\Exception $e) {

                        }
                    }

                    $quantity_pch = (int)$from_pch->inventario[0]->existencia;
                    $quantity_prestashop = (int)$quantities[$item['id']]['quantity'];

                    if ($quantity_pch !== $quantity_prestashop) {
                        try {
                            $this->editStock((int)$quantities[$item['id']]['id'], $quantity_pch);
                        } catch (\Exception $e) {

                        }
                    }
                }

            }
        }
    }

    /**
     * @return PrestashopClient
     */
    private function getPrestashopClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }

    /**
     * @return \SoapClient
     */
    private function getPchClient()
    {
        $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
        $soapClient = new \SoapClient($wsdl);
        return $soapClient;
    }

    /**
     * @return mixed
     */
    private function getParidad()
    {
        return $this->getPchClient()->ObtenerParidad('50527', '487478')->datos;
    }

    /**
     * @param $sku string
     * @return mixed
     */
    private function getArticleBySku($sku)
    {
        return $this->getPchClient()->ObtenerArticulo('50527', '487478', $sku)->datos;
    }

    /**
     * @param $article Articulo
     * @param $price_from_pch float
     * @return float
     */
    private function getPrecioUtilidad($article, $price_from_pch)
    {
        if ($article->moneda === 'MN') {
            $new_price = $price_from_pch;
        } else {
            $new_price = $price_from_pch * (double)$this->getParidad();
        }

        if ($article->tipo_utilidad_ps === 1) {
            $utilidad = $article->utilidad_ps + 1;
            $new_price *= $utilidad;
        } else if ($article->tipo_utilidad_ps === 2) {
            $utilidad = $article->utilidad_ps;
            $new_price += $utilidad;
        }

        return round($new_price, 2, PHP_ROUND_HALF_UP);

    }

    /**
     * @return array
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    private function getQuantity()
    {
        $client = $this->getPrestashopClient();

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

    /**
     * @return mixed
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    private function getProductsFromPrestashop()
    {
        $xml = $this->getPrestashopClient()->get(['resource' => 'products',
            'display' => '[id,reference,price]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
        ['products']['product'];

        return $items;
    }


    /**
     * @param $article Articulo
     * @param $id_prestashop string
     * @param $old_price float
     * @param $new_price float
     * @throws PrestaShopWebserviceException
     */
    private function editPrice($article, $id_prestashop, $old_price, $new_price)
    {
        $articuloPrestashop = ArticuloPrestashop::find()->where(['sku' => $article->sku])->one();

        if ($articuloPrestashop === null) {
            $articuloPrestashop = new ArticuloPrestashop();
            $articuloPrestashop->sku = $article->sku;
            $articuloPrestashop->cambio = TipoCambio::SIN_CAMBIOS;
            $articuloPrestashop->marca = $article->marca;
            $articuloPrestashop->serie = $article->serie;
        }

        $articuloPrestashop->id_prestashop = $id_prestashop;
        $article->precio = $new_price;

        $opt = array('resource' => 'products');
        $opt['id'] = $id_prestashop;

        $xml = $this->getPrestashopClient()->get($opt);
        $children = $xml->children()->children();
        unset($children->manufacturer_name, $children->quantity);

        $children->price = $new_price;
        $articuloPrestashop->precio = $new_price;
        $articuloPrestashop->precio_original = $old_price;

        $opt = array('resource' => 'products');
        $opt['putXml'] = $xml->asXML();
        $opt['id'] = $id_prestashop;

        try {
            $this->getPrestashopClient()->edit($opt);
        } catch (PrestaShopWebserviceException $e) {
        }

        $articuloPrestashop->save();
        $article->save();
    }

    /**
     * @param $stockId
     * @param $quantity
     * @throws PrestaShopWebserviceException
     */
    private function editStock($stockId, $quantity)
    {
        $xml = $this->obtenerSchemaUpdateStock($stockId);
        $xml->stock_available->quantity = $quantity;
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $stockId;
        $opt['putXml'] = $xml->asXML();

        $this->getPrestashopClient()->edit($opt);
    }

    /**
     * @param $id
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    private function obtenerSchemaUpdateStock($id)
    {
        $client = $this->getPrestashopClient();
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $id;
        return $client->get($opt);
    }

}