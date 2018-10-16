<?php

namespace console\controllers;

use yii\console\Controller;
use common\commands\AddToTimelineCommand;
use Yii;
use common\commands\SendEmailCommand;
use common\models\KeyStorageItem;
use yii\helpers\Url;
use backend\models\ArticuloComp;
use backend\models\ArticuloMayorista;
use backend\models\ArticuloPrestashop;
use backend\models\TipoCambio;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\client\PrestashopClient;
use backend\models\client\PchClient;
use backend\models\constants\Constantes;
use backend\models\util\Util;
use phpDocumentor\Reflection\Types\Null_;
use backend\models\Articulo;


/**
 * Test controller
 */
class SuperTiendaController extends Controller {

    public function actionIndex() {
        echo "cron service runnning";


        $this->syncPHC();
    }

    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }


    public function actionHourly() {
        // every hour
        $current_hour = date('G');

        if ($current_hour%4) {
            // every four hours
        }
        if ($current_hour%6) {
            // every six hours
        }


    }




    private static  function syncPHC(){

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

           $priceChangeItems = [];

           $quantityChangeItems = [];

           $hubItemsDb = Articulo::find()->all();

           $hubItems = [];
           foreach ($hubItemsDb as $hubItem)
                    $hubItems[$hubItem->sku] = $hubItem;

           foreach ($items as $item) {

               $item['quantity'] = isset($quantities[$item['id']])?$quantities[$item['id']]:0;
               $psItems[$item['reference']] = $item;
               $sku = $item['reference'];

               if(isset($pchItems[$sku]) && isset($hubItems[$sku])){

                   $precioPs = round(Util::getPSFinalprice($pchItems[$sku]->precio, $pchItems[$sku]->utilidad_ps, $dollar, ($pchItems[$sku]->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$pchItems[$sku]->tipo_utilidad_ps),2);

                   if($precioPs !==  round($item['price'],2) ){

                       $estatus = $precioPs > round($item['price'],2);

                       $priceChangeItems[$sku] = [$item,'estatus'=>$estatus];

                   }

                   if($pchItems[$sku]->inventario[0]->existencia*1 !==$item['quantity']*1 )
                       $quantityChangeItems[$sku] = [$item,'estatus'=>$pchItems[$sku]->inventario[0]->existencia*1 > $item['quantity']*1];


               }

              }



       /** foreach ($soap_response as $articulo){

            $model =  new ArticuloMayorista();
            $model->attributes = get_object_vars($articulo);

            $dbModel = ArticuloMayorista::findOne($model->sku);



            if (  !$dbModel || $dbModel->precio*1 !==  $model->precio*1)
                $articles[$model->sku] = ['dbmodel'=>$dbModel->attributes, 'model'=>$model->attributes];

        }


        if (count($articles)){

        \Yii::$app->mailer->compose()
        ->setTo( \Yii::$app->keyStorage->get('config.phc.aviso.correo', 'jjnataren@hotmail.com'))
        ->setSubject('PHC Mayoristas ha cambiado articulos')
        ->setTextBody('PHC Mayoristas ha cambiado articulos')
        ->setHtmlBody('<h1>PHC Mayoristas ha cambiado artículos</h1>
                          <p> En el siguiente <a href="http://supertiendahub.local/articulo-mayorista" targer="_blank">Enlace</a> podra ver el detalle.  </p>

                        ')
        ->send();


        $addToTimelineCommand = new AddToTimelineCommand([
            'category' => 'phc',
            'event' => 'change',
            'data' => ['articles' => $articles]
        ]);


        Yii::$app->commandBus->handle($addToTimelineCommand);

        }else
            echo 'There are not changes in phc';*/
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

