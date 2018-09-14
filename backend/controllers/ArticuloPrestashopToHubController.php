<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\client\PrestashopClient;
use common\models\KeyStorageItem;
use Yii;

class ArticuloPrestashopToHubController extends \yii\web\Controller
{
    /**
     * @return string
     * @throws \backend\models\client\PrestaShopWebserviceException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {

        $client = $this->getClient();

        $xml = $client->get(['resource' => 'products',
            'display' => '[id,reference,price,quantity]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
        ['products']['product'];

        $results = array();

        foreach ($items as $item) {
            $article = Articulo::find()->where(['sku' => $item['reference']])->one();

            if ($article !== null) {

                $quantity_ps = (int)$item['quantity'];
                $quantity_hub = (int)$article['existencia_ps'];

                if ($quantity_ps !== $quantity_hub) {
                    $result = array(
                        'id_prestashop' => $item['id'],
                        'reference' => $item['reference'],
                        'quantity' => $quantity_ps,
                        'quantity_hub' => $quantity_hub,
                        'description'=>$article->descripcion
                    );

                    $results[] = $result;
                }

            }

        }

        return $this->render('index', ['result' => $results]);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function actionImport() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $tochannge = Yii::$app->getRequest()->getBodyParams();

        $articulo = Articulo::find()->where(['sku' => $tochannge['reference']])->one();
        $articulo->existencia_ps = $tochannge['quantity'];
        $articulo->save();

        return $tochannge;
    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }

}
