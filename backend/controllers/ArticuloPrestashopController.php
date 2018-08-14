<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\search\ArticuloPrestashopSearch;
use backend\models\search\ArticuloSearch;
use backend\models\TipoCambio;
use common\commands\AddToTimelineCommand;
use common\models\KeyStorageItem;
use trntv\bus\exceptions\MissingHandlerException;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticuloPrestashopController implements the CRUD actions for ArticuloPrestashop model.
 */
class ArticuloPrestashopController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ArticuloPrestashop::find()->all();
    }

    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $client = $this->getClient();
        $articles = Articulo::find()->all();
        $prestashop = array();

        $dollarPrice = $this->getParidad();

        foreach ($articles as $article) {
            try {
                $opt = array('resource' => 'products');
                $opt['filter[reference]'] = $article->sku;
                $xml = $client->get($opt)->children();

                if ($xml->children()[0] !== null) {
                    $xml = $xml->children();
                    $id = $this->xml_attribute($xml->attributes(), 'id');
                    $articlePrestashop = null;

                    $optArticle = array('resource' => 'products', 'id' => $id);
                    $articleXml = $client->get($optArticle)->product;

                    $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articlePrestashop !== null) {

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

                        $articlePrestashop->id_prestashop = $id;
                        $precio = round($precio, 2, PHP_ROUND_HALF_UP);
                        $precio_prestashop = round((float)$articleXml->price, 2, PHP_ROUND_HALF_UP);

                        if (number_format($precio_prestashop, 2) !== number_format($articlePrestashop->precio, 2)) {
                            $articlePrestashop->cambio = 1;
                            $articlePrestashop->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $articlePrestashop->precio = $precio;
                            $prestashop[] = $articlePrestashop;
                            $articlePrestashop->save();
                        } else if (number_format($article->precio, 2) !== number_format($articlePrestashop->precio_original, 2)) {
                            $articlePrestashop->cambio = 1;
                            $articlePrestashop->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $articlePrestashop->precio = $precio;
                            $prestashop[] = $articlePrestashop;
                            $articlePrestashop->save();
                        } else if (number_format($precio, 2) !== number_format($articlePrestashop->precio, 2)) {
                            $articlePrestashop->cambio = 1;
                            $articlePrestashop->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $articlePrestashop->precio = $precio;
                            $prestashop[] = $articlePrestashop;
                            $articlePrestashop->save();
                        } else if ($articlePrestashop->cambio === 1) {
                            $prestashop[] = $articlePrestashop;
                        } else if (!$this->compareStock($articleXml, (int)$article->existencia_ps)) {
                            $articlePrestashop->cambio = 1;
                            $articlePrestashop->tipo_cambio = TipoCambio::CAMBIO_CANTIDAD;
                            $prestashop[] = $articlePrestashop;
                            $articlePrestashop->save();
                        }
                    } else {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = $id;
                        $articlePrestashop->marca = $article->marca;
                        $articlePrestashop->serie = $article->serie;
                        $articlePrestashop->cambio = 1;
                        $articlePrestashop->precio = round((double)$articleXml->price, 2, PHP_ROUND_HALF_UP);
                        $articlePrestashop->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                        $articlePrestashop->tipo_cambio = TipoCambio::ALTA_SISTEMA;

                        $articlePrestashop->save();
                        $prestashop[] = $articlePrestashop;
                    }
                } else {

                    $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articlePrestashop === null) {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = 'Sin asignar';
                        $articlePrestashop->precio = round($article->precio, 2, PHP_ROUND_HALF_UP);
                        $articlePrestashop->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                        $articlePrestashop->save();
                    }

                    $articlePrestashop->cambio = 1;
                    $articlePrestashop->tipo_cambio = TipoCambio::NUEVO;

                    $prestashop[] = $articlePrestashop;
                }
            } catch (PrestaShopWebserviceException $e) {
            }
        }
        return $prestashop;
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

    function xml_attribute($object, $attribute)
    {
        if (isset($object[$attribute])) {
            return (string)$object[$attribute];
        }
        return '';
    }

    /**
     * @param $xml
     * @param $quantity
     * @return bool
     * @throws PrestaShopWebserviceException
     */
    private function compareStock($xml, $quantity)
    {
        $stockId = $xml->associations->stock_availables->stock_available->id;
        $xmlStock = $this->obtenerSchemaUpdateStock($stockId);
        return (int)$xmlStock->stock_available->quantity === $quantity;
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
     * @return array|PrestaShopWebserviceException|\Exception
     * @throws PrestaShopWebserviceException
     */
    public function actionUpdatePrices()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;

        $dollarPrice = $this->getParidad();

        $prestashop = array();

        if ($request->isAjax && $request->isPost) {
            foreach ($request->bodyParams as $product) {
                $client = $this->getClient();

                $tipoOperacion = $product['tipo_cambio'];

                if ($tipoOperacion === TipoCambio::NUEVO) {
                    $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                    $articlePrestashop = ArticuloPrestashop::find()->where(['sku' => $product['sku']])->one();

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

                    $xml = $this->obtenerXmlNuevoProducto();

                    $xml->product->id_manufacturer = 0;
                    $xml->product->id_supplier = 0;
                    $xml->product->id_category_default = 2;
                    $xml->product->cache_default_attribute = 0;
                    $xml->product->id_tax_rules_group = 0;
                    $xml->product->type = 'simple';
                    $xml->product->id_shop_default = 1;
                    $xml->product->reference = $product['sku'];
                    $xml->product->price = $precio;
                    $xml->product->active = 0;

                    $xml->product->link_rewrite->language[0] = str_replace(';', ' ', $article->descripcion);
                    $xml->product->link_rewrite->language[1] = str_replace(';', ' ', $article->descripcion);

                    $xml->product->name->language[0] = str_replace(';', ' ', $article->descripcion);
                    $xml->product->name->language[1] = str_replace(';', ' ', $article->descripcion);

                    $opt = array('resource' => 'products');
                    $opt['postXml'] = $xml->asXML();

                    $response = $client->add($opt);

                    $articlePrestashop->precio = $precio;
                    $articlePrestashop->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                    $articlePrestashop->marca = $article->marca;
                    $articlePrestashop->serie = $article->serie;
                    $articlePrestashop->id_prestashop = (string)$response->product->id;
                    $articlePrestashop->tipo_cambio = TipoCambio::SIN_CAMBIOS;
                    $articlePrestashop->cambio = 0;

                    $articlePrestashop->save();

                    try {
                        $this->getAndUpdateStock($articlePrestashop->id_prestashop, $article->existencia_ps);
                    } catch (PrestaShopWebserviceException $e) {

                    }

                    $prestashop[] = $articlePrestashop;
                } else {
                    try {
                        $opt = array('resource' => 'products');
                        $opt['id'] = $product['id_prestashop'];

                        $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                        $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $product['sku']])->one();


                        $xml = $client->get($opt);
                        $children = $xml->children()->children();
                        unset($children->manufacturer_name, $children->quantity);

                        $editar = true;

                        if ($tipoOperacion === TipoCambio::HABILITAR) {
                            $children->active = 1;
                        } else if ($tipoOperacion === TipoCambio::INHABILITAR) {
                            $children->active = 0;
                        } else if ($tipoOperacion === TipoCambio::ALTA_SISTEMA || $tipoOperacion === TipoCambio::CAMBIO_PRECIO) {
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

                            $children->price = $precio;
                            $articlePrestashop->precio = $precio;
                            $articlePrestashop->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                        } else if ($tipoOperacion === TipoCambio::CAMBIO_CANTIDAD) {
                            $this->editStock($xml, $article->existencia_ps);
                            $editar = false;
                        }

                        $articlePrestashop->cambio = 0;
                        $articlePrestashop->tipo_cambio = TipoCambio::SIN_CAMBIOS;

                        if ($editar) {
                            $opt = array('resource' => 'products');
                            $opt['putXml'] = $xml->asXML();
                            $opt['id'] = $product['id_prestashop'];

                            try {
                                $client->edit($opt);
                            } catch (PrestaShopWebserviceException $e) {
                            }
                        }

                        $articlePrestashop->save();

                        $prestashop[] = $articlePrestashop;
                    } catch (PrestaShopWebserviceException $e) {
                        return $e;
                    }
                }
            }
        }

        try {
            $addToTimelineCommand = new AddToTimelineCommand([
                'category' => 'prestashop',
                'event' => 'change',
                'data' => ['articles' => $prestashop]
            ]);

            Yii::$app->commandBus->handle($addToTimelineCommand);
        } catch (MissingHandlerException $igored) {
        } catch (InvalidConfigException $igored) {
        }

        return $prestashop;
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
        $client = $this->getClient();
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
        $client = $this->getClient();
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

        $this->getClient()->edit($opt);
    }

    /**
     * Lists all PS Items throught partial render view
     * @return string
     * @throws PrestaShopWebserviceException
     */
    public function actionGetItemsView()
    {

        $client = $this->getClient();


        try {

            $xml = $client->get(['resource' => 'products',
                'display' => '[id,name, description,reference,price,quantity]'
            ]);

            $items = json_decode(json_encode((array)$xml)
                , TRUE)
            ['products']['product'];

        } catch (PrestaShopWebserviceException $e) {
            throw $e;
        }

        return $this->renderPartial('_get_items_view', ['items' => $items]);
    }

    /**
     * Lists all ArticuloPrestashop models.
     * @return mixed
     */
    public function actionIndex()
    {
        try {
            $paridad = $this->getParidad();
        } catch (\Exception $e) {
            $paridad = 0;
        }

        $searchModel = new ArticuloPrestashopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paridad' => $paridad,
        ]);
    }

    /**
     * Displays a single ArticuloPrestashop model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the ArticuloPrestashop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ArticuloPrestashop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloPrestashop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ArticuloPrestashop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloPrestashop();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prestashop]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticuloPrestashop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prestashop]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ArticuloPrestashop model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionHubPrestashop()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return (new Query())
            ->select(['ap.sku', 'a.descripcion', 'a.precio as precio', 'ap.precio_original as precio_prestashop', 'ap.precio as precio_utilidad'])
            ->from(['tbl_articulo a', 'tbl_articulo_prestashop ap'])
            ->where('a.sku = ap.sku')
            ->all();
    }

    /**
     * @throws PrestaShopWebserviceException
     * @throws InvalidConfigException
     */
    public function actionHubOnlinePrestashop()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $formatter = Yii::$app->formatter;

        $client = $this->getClient();

        $xml = $client->get(['resource' => 'products',
            'display' => '[id,reference,price]'
        ]);

        $items = json_decode(json_encode((array)$xml)
            , TRUE)
        ['products']['product'];

        $results = array();

        foreach ($items as $item) {
            $articuloPrestashop = ArticuloPrestashop::find()->where(['id_prestashop' => $item['id']])->one();

            $result = array(
                'id_prestashop' => $item['id'],
                'reference' => $item['reference'],
                'price' => '$' . $formatter->asCurrency($item['price'], 'MXN'),
                'price_hub' => '$' . $formatter->asCurrency($articuloPrestashop['precio'], 'MXN')
            );

            $results[] = $result;
        }

        return $results;
    }

}
