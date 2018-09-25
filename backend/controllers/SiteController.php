<?php

namespace backend\controllers;

use common\components\keyStorage\FormModel;
use common\models\KeyStorageItem;
use Yii;
use backend\models\search\ArticuloSearch;
use backend\models\search\ArticuloMeliSearch;
use backend\models\search\ArticuloPrestashopSearch;
use backend\models\Articulo;
use backend\models\client\PrestashopClient;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
        return parent::beforeAction($action);
    }


    public function actionDashboard(){


        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelML = new ArticuloMeliSearch();
        $dataProviderML = $searchModelML->search(Yii::$app->request->queryParams);


        $searchModelPS = new ArticuloPrestashopSearch();
        $dataProviderPS = $searchModelPS->search(Yii::$app->request->queryParams);


        $wsdl =
        \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8088/servidor.php?wsdl');

        $cliente =
        \Yii::$app->keyStorage->get('config.phc.webservice.cliente', '50527');

        $llave =
        \Yii::$app->keyStorage->get('config.phc.webservice.llave', '487478');

        $params = "<cliente>$cliente</cliente><llave>$llave</llave>";

        $client = new \SoapClient($wsdl);
        //$valores = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;

        $dollar =  (float)$client->ObtenerParidad(new \SoapVar($params, XSD_ANYXML))->datos;

        $soap_response = $client->ObtenerListaArticulos( new \SoapVar($params, XSD_ANYXML))->datos;

        $pchItems = [];



        $psClient = $this->getPsClient();

        $xml = $psClient->get(['resource' => 'products',
            'display' => '[id,reference,price,quantity]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
            ['products']['product'];

        $quantities = $this->getQuantity();

        $psItems = [];

         foreach ($items as $item) {


             $item['quantity'] = isset($quantities[$item['id']])?$quantities[$item['id']]:0;
               $psItems[$item['reference']] = $item;

         }


        foreach ($soap_response as $articulo){


            $model =  new Articulo();
            $model->attributes = get_object_vars($articulo);
            $model->existencia = $articulo->inventario[0]->existencia;

            $pchItems[$model->sku] = $model;

        }


        $hubItems = Articulo::find()->all();



        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelML' => $searchModelML,
            'dataProviderML' => $dataProviderML,
            'searchModelPS' => $searchModelPS,
            'dataProviderPS' => $dataProviderPS,
            'dollar'=>$dollar,
            'pchItems'=>$pchItems,
            'psItems'=>$psItems,
            'hubItems'=>$hubItems
        ]);
    }

    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
                'backend.theme-skin' => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'backend.layout-fixed' => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-boxed' => [
                    'label' => Yii::t('backend', 'Boxed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-collapsed-sidebar' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }

/**
 * Gets PrestashopClient by own
 * @return \backend\models\client\PrestashopClient
 */
    private function getPsClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }



    /**
     * @param $id_product
     * @return array
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    private function getQuantity()
    {
        $client = $this->getPsClient();

        $xml = $client->get(['resource' => 'stock_availables',
            'display' => '[quantity,id_product]'
        ]);

        $items = json_decode(json_encode((array)$xml), TRUE)
        ['stock_availables']['stock_available'];

        $responses = array();

        foreach ($items as $item) {
            $responses[(string)$item['id_product']] = $item['quantity'];
        }

        return $responses;
    }


}
