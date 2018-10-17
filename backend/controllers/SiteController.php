<?php

namespace backend\controllers;

use common\components\keyStorage\FormModel;
use common\models\KeyStorageItem;
use Yii;
use backend\models\search\ArticuloSearch;
use backend\models\search\ArticuloMeliSearch;
use backend\models\search\ArticuloPrestashopSearch;
use backend\models\util\Util;
use backend\models\Articulo;
use backend\models\client\PchClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\client\PrestashopClient;
use backend\models\constants\Constantes;
use yii\web\BadRequestHttpException;
use yii\base\Model;
use backend\models\ArticuloComp;
use backend\models\ArticuloPrestashop;
use backend\models\TipoCambio;
use yii\web\NotFoundHttpException;

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




        if (isset($_POST['hasEditable'])) {
            // use Yii's response format to encode output as JSON
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


            $key = Yii::$app->request->post('editableIndex');
            $sku = Yii::$app->request->post('editableKey');
            $attr = Yii::$app->request->post('editableAttribute');

            $model = Articulo::findOne($sku);

            $existenciaPsPost= false;

            if ($pchPrecio = Yii::$app->request->post('pch_precio') )
                        $model->precio = $pchPrecio*1;
                        elseif($pchExistencia = Yii::$app->request->post('pch_existencia') ){
                          //  if($psExistencia*1>$model->existencia)
                            //    throw new BadRequestHttpException('La cantidad excede.');
                          $model->existencia=$pchExistencia;
                        }elseif($psPrecioUtil = Yii::$app->request->post('ps_precio_util')){

                            $model->attributes = Yii::$app->request->post('ArticuloComp');


                        }elseif( isset($_POST['existencia_ps'])){

                            $existenciaPs = Yii::$app->request->post('existencia_ps');

                            $existenciaPsPost = true;

                            $model->existencia_ps = $existenciaPs;


                        }

            // read your posted model attributes
                        if ($model && isset($key) &&( ($model->attributes = Yii::$app->request->post('Articulo')[$key]) ||$existenciaPsPost ||$pchPrecio || $pchExistencia || $psPrecioUtil) ) {
                // read or convert your posted information
                                $model->ultima_modificacion = date ('Y-m-d H:i:s');
                            if ($model->save())
                               return ['output'=>'...', 'message'=>''];
                            else return ['output'=>'', 'message'=>'No fue posible aplicar el cambio'];

                        }elseif ($psPublicPrecio = Yii::$app->request->post('ps_public_precio')){

                            $modelComplement = new ArticuloComp();


                            $articuloComp = Yii::$app->request->post('ArticuloComp');
                            $modelComplement->attributes = $articuloComp;
                            $modelComplement->precioPs = $articuloComp['precioPs'];
                            $modelComplement->precioPsOriginal = $articuloComp['precioPsOriginal'];


                            if ($modelComplement->idPs = $articuloComp['idPs']){

                                 $this->savePsPrice($modelComplement);
                            }else{

                                $this->publicNewPs($modelComplement);
                            }

                        }elseif( isset($_POST['ps_publicar_cantidad'])){

                            $modelComplement = new ArticuloComp();
                            $articuloComp = Yii::$app->request->post('ArticuloComp');
                            $modelComplement->attributes = $articuloComp;
                            $modelComplement->idPs = $articuloComp['idPs'];

                            if($modelComplement->idPs)
                                $this->updatePsQuantity($modelComplement);

                        }elseif(  isset($_POST['ps_importar_cantidad_hub']) ){

                            $modelComplement = new ArticuloComp();
                            $articuloComp = Yii::$app->request->post('ArticuloComp');
                            $modelComplement->attributes = $articuloComp;

                            if(  $updatedModel = Articulo::findOne($modelComplement->sku) ){
                                //TODO:Get quantity from Prestashop online
                                $updatedModel->existencia_ps = $modelComplement->existencia_ps;

                                if(!$updatedModel->save(false))
                                    throw new BadRequestHttpException('Datos incorrectos');


                            }else{

                                throw new NotFoundHttpException('No existe el producto');
                            }



                        }
            // else if nothing to do always return an empty JSON encoded output
                         else {
                                return ['output'=>'', 'message'=>'Err'];
                            }
        }

        $searchModelML = new ArticuloMeliSearch();
        $dataProviderML = $searchModelML->search(Yii::$app->request->queryParams);


        $searchModelPS = new ArticuloPrestashopSearch();
        $dataProviderPS = $searchModelPS->search(Yii::$app->request->queryParams);


        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $dollar =  PchClient::ObtenerParidad(null,null);





        $pchItems = [];



        $psClient = $this->getPsClient();

        $xml = $psClient->get(['resource' => 'products',
            'display' => '[id,name,reference,price,quantity]'
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



            $models = $dataProvider->getModels();

            $pchItemsTmp = PchClient::ObtenerListaArticulos(null,null);

            $hubItems = [];

            foreach ($models as $mod){


                if (isset  ($pchItemsTmp[$mod->sku]) )
                    $pchItems [$mod->sku] =  $pchItemsTmp[$mod->sku];

                $hubItems[$mod->sku] = 1;

                unset($pchItemsTmp[$mod->sku]);

            }


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
            'hubItems'=>$hubItems,
            'pchItemsAll'=>$pchItemsTmp

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


    public function actionTest(){

        $numeroCambios = 0;


        $pchItems = PchClient::ObtenerListaArticulos(null,null);
        $dollar = PchClient::ObtenerParidad(null,null);

        $psClient = $this->getPsClient();

        $xml = $psClient->get(['resource' => 'products',
            'display' => '[id,name,reference,price,quantity]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
            ['products']['product'];

            $quantities = $this->getQuantity();

            $psItems = [];

            $toChangeItems = [];



            $hubItemsDb = Articulo::find()->all();

            $hubItems = [];
            foreach ($hubItemsDb as $hubItem)
                $hubItems[$hubItem->sku] = $hubItem;

                foreach ($items as $item) {

                    $item['quantity'] = isset($quantities[$item['id']])?$quantities[$item['id']]:0;
                    $psItems[$item['reference']] = $item;
                    $sku = $item['reference'];
                    $priceChange = false;
                    $quantityChange = false;


                    if(isset($pchItems[$sku]) && isset($hubItems[$sku])){

                        $precioPs = round(Util::getPSFinalprice($pchItems[$sku]->precio, $hubItems[$sku]->utilidad_ps, $dollar, ($pchItems[$sku]->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$hubItems[$sku]->tipo_utilidad_ps),2);

                        if($precioPs !==  round($item['price'],2) ){

                            $estatus = $precioPs > round($item['price'],2);

                            $priceChange = true;

                            $hubItems[$sku]->precio = $pchItems[$sku]->precio;


                        }

                        if($pchItems[$sku]->inventario[0]->existencia*1 !==$item['quantity']*1 ) {

                            $hubItems[$sku]->existencia = $pchItems[$sku]->inventario[0]->existencia*1;
                            $hubItems[$sku]->existencia_ps = $pchItems[$sku]->inventario[0]->existencia*1;

                            $quantityChange = true;

                        }

                        if ($priceChange || $quantityChange){

                            $toChangeItems[$sku] = ['psItem'=> $item,'quantityChange'=>$quantityChange,'priceChange'=>$priceChange, 'hubItem'=>$hubItems[$sku]];

                        }


                    }

                }


                foreach ($toChangeItems as $sku=>$changes){


                    $articuloComp = new ArticuloComp();
                    $articuloComp->idPs = $changes['psItem']['id'];
                    $articuloComp->precioPsOriginal = $changes['psItem']['price'];
                    $articuloComp->precioPs = round(Util::getPSFinalprice( $changes['hubItem']->precio, $changes['hubItem']->utilidad_ps, $dollar, ($changes['hubItem']->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$changes['hubItem']->tipo_utilidad_ps),2);
                    $articuloComp->sku = $sku;
                    $articuloComp->existencia_ps = $changes['hubItem']->existencia;;

                    if($changes['priceChange']){


                        $this->savePsPrice($articuloComp);
                        $changes['hubItem']->save();


                    }
                    if($changes['quantityChange']){


                        $this->updatePsQuantity($articuloComp);
                        $changes['hubItem']->save();


                    }



                }



                return json_encode(['toChangeItems'=>$toChangeItems]);

    }



    public function actionGetPchItems(){


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $hubItems = Articulo::find()->select(['sku'])->indexBy('sku')->column();

        $pchItems = PchClient::ObtenerListaArticulos();

        $json_items = [];


        $data = [];

        foreach ($pchItems as $item){


         //   $json_items['sku'] =  $item->sku ['sku'=>$item->sku,'description'=>$item->descripcion, 'price'=>$item->precio,'currency'=>$item->moneda,'avaliable'=>$item->inventario[0]->existencia,'action'=>''];

            $json_items =  [$item->sku,$item->descripcion, $item->precio,$item->moneda,$item->inventario[0]->existencia,''];


            $data [] = $json_items;

        }


        return  ['data'=>$data];

     /*   { "data": "sku" },
        { "data": "description" },
        { "data": "price" },
        { "data": "currency" },
        { "data": "avaliable" },
        { "data": "action" }
*/


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


    /**
     * @param ArticuloComp
     * @throws PrestaShopWebserviceException
     */
    private function savePsPrice($article)
    {



        $opt = array('resource' => 'products');
        $opt['id'] = $article->idPs;

        $xml = $this->getPsClient()->get($opt);
        $children = $xml->children()->children();
        unset($children->manufacturer_name, $children->quantity);

        $children->price = $article->precioPs;

        if(!($articuloPrestashop = ArticuloPrestashop::findOne($article->sku))){
             $articuloPrestashop = new ArticuloPrestashop();
                $articuloPrestashop->sku = $article->sku;
                $articuloPrestashop->precio = $article->precioPs;
                $articuloPrestashop->precio_original = $article->precioPsOriginal;
                $articuloPrestashop->id_prestashop = $article->idPs;
        }else{

            $articuloPrestashop->precio = $article->precioPs;
            $articuloPrestashop->precio_original = $article->precioPsOriginal;

        }


        $opt = array('resource' => 'products');
        $opt['putXml'] = $xml->asXML();
        $opt['id'] = $article->precioPs;

        try {
            $this->getPsClient()->edit($opt);
        } catch (PrestaShopWebserviceException $e) {
        }

        $articuloPrestashop->save(false);
    }



    /**
     *
     * @param ArticuloComp $articuloComp
     * @throws PrestaShopWebserviceException
     */
    private function publicNewPs($articuloComp){



        $xml = $this->obtenerXmlNuevoProducto();

        $client = $this->getPsClient();

        $xml->product->id_manufacturer = 0;
        $xml->product->id_supplier = 0;
        $xml->product->id_category_default = 2;
        $xml->product->cache_default_attribute = 0;
        $xml->product->id_tax_rules_group = 0;
        $xml->product->type = 'simple';
        $xml->product->id_shop_default = 1;
        $xml->product->reference = $articuloComp->sku;
        $xml->product->price = $articuloComp->precioPs;
        $xml->product->active = 1;

        $xml->product->link_rewrite->language[0] = str_replace(';', ' ', $articuloComp->descripcion);
        $xml->product->link_rewrite->language[1] = str_replace(';', ' ', $articuloComp->descripcion);

        $xml->product->name->language[0] = str_replace(';', ' ', $articuloComp->descripcion);
        $xml->product->name->language[1] = str_replace(';', ' ', $articuloComp->descripcion);

        $opt = array('resource' => 'products');
        $opt['postXml'] = $xml->asXML();

        $response = $client->add($opt);

        if(!($articlePrestashop = ArticuloPrestashop::findOne($articuloComp->sku))){
            $articlePrestashop = new ArticuloPrestashop();
            $articlePrestashop->sku = $articuloComp->sku;
        }
        $articlePrestashop->precio = $articuloComp->precioPs;
        $articlePrestashop->precio_original = $articuloComp->precioPsOriginal;
        $articlePrestashop->id_prestashop = (string)$response->product->id;
        $articlePrestashop->tipo_cambio = TipoCambio::SIN_CAMBIOS;
        $articlePrestashop->cambio = 0;
        $articlePrestashop->save(false);

        if ($articuloComp->existencia_ps>0)
            try {
                $this->getAndUpdateStock( $articlePrestashop->id_prestashop, $articuloComp->existencia_ps);
            } catch (PrestaShopWebserviceException $e) {
                throw $e;
            }

    }


    /**
     * Updates ps-item quantity
     * @param ArticuloComp $articleComp
     * @throws PrestaShopWebserviceException
     */
    private function updatePsQuantity($articleComp){

        try {
            $this->getAndUpdateStock( $articleComp->idPs, $articleComp->existencia_ps);
        } catch (PrestaShopWebserviceException $e) {
            throw $e;
        }

    }


    /**
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    private function obtenerXmlNuevoProducto()
    {
        $xml = $this->obtenerNuevoSchemaCreateProduct();

        unset(
            $xml->product->id,
            $xml->product->new,
            $xml->product->id_default_image,
            $xml->product->id_default_combination,
            $xml->product->position_in_category,
            $xml->product->supplier_reference,
            $xml->product->location,
            $xml->product->width,
            $xml->product->height,
            $xml->product->depth,
            $xml->product->weight,
            $xml->product->quantity_discount,
            $xml->product->ean13,
            $xml->product->upc,
            $xml->product->cache_is_pack,
            $xml->product->cache_has_attachments,
            $xml->product->is_virtual,
            $xml->product->on_sale,
            $xml->product->online_only,
            $xml->product->ecotax,
            $xml->product->minimal_quantity,
            $xml->product->wholesale_price,
            $xml->product->unity,
            $xml->product->unit_price_ratio,
            $xml->product->additional_shipping_cost,
            $xml->product->customizable,
            $xml->product->text_fields,
            $xml->product->uploadable_files,
            $xml->product->redirect_type,
            $xml->product->id_product_redirected,
            $xml->product->available_for_order,
            $xml->product->available_date,
            $xml->product->condition,
            $xml->product->show_price,
            $xml->product->indexed,
            $xml->product->visibility,
            $xml->product->advanced_stock_management,
            $xml->product->date_add,
            $xml->product->date_upd,
            $xml->product->meta_description,
            $xml->product->pack_stock_type,
            $xml->product->meta_keywords,
            $xml->product->meta_title,
            $xml->product->description,
            $xml->product->description_short,
            $xml->product->available_now,
            $xml->product->available_later,
            $xml->product->associations
            );

        return $xml;
    }

    /**
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    private function obtenerNuevoSchemaCreateProduct()
    {
        $client = $this->getPsClient();
        $opt = array('resource' => 'products');
        $opt['schema'] = 'blank';

        return $client->get($opt);
    }

    /**
     * @param $id_prestashop
     * @param $quantity
     * @throws PrestaShopWebserviceException
     */
    private function getAndUpdateStock($id_prestashop, $quantity) {
        $client = $this->getPsClient();
        $opt = array('resource' => 'products');
        $opt['id'] = $id_prestashop;
        $xml = $client->get($opt);

        $this->editStock($xml, $quantity);
    }

    /**
     * @param $xml
     * @param $quantity
     * @return string
     * @throws PrestaShopWebserviceException
     */
    private function editStock($xml, $quantity)
    {
        $stockId = $xml->product->associations->stock_availables->stock_available->id;

        $xml = $this->obtenerSchemaUpdateStock($stockId);
        $xml->stock_available->quantity = $quantity;
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $stockId;
        $opt['putXml'] = $xml->asXML();

        $this->getPsClient()->edit($opt);
    }


    /**
     * @param $id
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    private function obtenerSchemaUpdateStock($id)
    {
        $client = $this->getPsClient();
        $opt = array('resource' => 'stock_availables');
        $opt['id'] = $id;
        return $client->get($opt);
    }

}
