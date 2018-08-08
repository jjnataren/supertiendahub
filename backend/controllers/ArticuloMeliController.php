<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloMeli;
use backend\models\client\MeliOAuth2Client;
use backend\models\MeliModel;
use backend\models\search\ArticuloMeliSearch;
use backend\models\search\ArticuloSearch;
use backend\models\TipoCambio;
use common\commands\AddToTimelineCommand;
use common\models\KeyStorageItem;
use trntv\bus\exceptions\MissingHandlerException;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticuloMeliController implements the CRUD actions for ArticuloMeli model.
 */
class ArticuloMeliController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @return string
     */
    public function actionGetItemsView()
    {

        $client = $this->getClient();

        $items = [];

        try {
            $security = Yii::$app->getSecurity();
            $userId = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.userid')->value), env('SECRET_KEY'));
            $url = 'users/' . $userId . '/items/search';
            $articlesMeli = $client->get($url)->getData()['results'];


            foreach ($articlesMeli as $key => $value) {

                $url = 'items/' . $value;

                $items[$value] = $client->get($url)->getData();

            }


        } catch (\Exception $e) {
        }


        return $this->renderPartial('_get_items_view', ['items' => $items]);

    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $clientSecret = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.secret')->value), env('SECRET_KEY'));
        $clientId = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.id')->value), env('SECRET_KEY'));
        $tokenUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.url.token')->value), env('SECRET_KEY'));
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.url.api')->value), env('SECRET_KEY'));
        $userId = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.userid')->value), env('SECRET_KEY'));

        $client = new MeliOAuth2Client();
        $client->clientSecret = $clientSecret;
        $client->clientId = $clientId;
        $client->tokenUrl = $tokenUrl;
        $client->apiBaseUrl = $apiUrl;
        $client->userId = $userId;

        $client->authenticateClient();

        return $client;
    }

    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = $this->getClient();
        $articles = Articulo::find()->all();
        $dollarPrice = $this->getParidad();

        $meli = array();

        foreach ($articles as $article) {
            try {
                $security = Yii::$app->getSecurity();
                $userId = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.userid')->value), env('SECRET_KEY'));

                $url = 'users/' . $userId . '/items/search';
                $articlesMeli = $client->get($url, ['sku=' . $article->sku])->getData()['results'];

                if (\count($articlesMeli) > 0) {
                    $url = 'items/' . $articlesMeli[0];
                    $articleMeliJson = $client->get($url)->getData();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articleMeli !== null) {

                        $precio = $this->obtenerPrecio($article, $dollarPrice);
                        $precio_meli = round((float)$articleMeliJson['price'], 2, PHP_ROUND_HALF_UP);

                        if (number_format($precio_meli, 3) !== number_format($articleMeli->precio, 3)) {
                            $articleMeli->cambio = 1;
                            $articleMeli->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $meli[] = $articleMeli;
                            $articleMeli->save();
                        } else if (number_format($article->precio, 3) !== number_format($articleMeli->precio_original, 3)) {
                            $articleMeli->cambio = 1;
                            $articleMeli->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $meli[] = $articleMeli;
                            $articleMeli->save();
                        } else if (number_format($precio, 3) !== number_format($articleMeli->precio, 3)) {
                            $articleMeli->cambio = 1;
                            $articleMeli->tipo_cambio = TipoCambio::CAMBIO_PRECIO;
                            $meli[] = $articleMeli;
                            $articleMeli->save();
                        } else if (!$this->compareStock($articleMeliJson, $article->existencia_ml)) {
                            $articleMeli->cambio = 1;
                            $articleMeli->tipo_cambio = TipoCambio::CAMBIO_CANTIDAD;
                            $meli[] = $articleMeli;
                            $articleMeli->save();
                        } else if ($articleMeli->cambio === 1) {
                            $meli[] = $articleMeli;
                        }
                    } else {

                        $precioMeli = round($articleMeliJson['price'], 2, PHP_ROUND_HALF_UP);
                        $precio = round($article->precio);

                        $articleMeli = new ArticuloMeli();
                        $articleMeli->precio = $precioMeli;
                        $articleMeli->sku = $article->sku;
                        $articleMeli->id = $articlesMeli[0];
                        $articleMeli->marca = $article->marca;
                        $articleMeli->serie = $article->serie;
                        $articleMeli->precio_original = $precio;

                        $articleMeli->cambio = 1;
                        $articleMeli->tipo_cambio = TipoCambio::ALTA_SISTEMA;

                        $articleMeli->save();

                        $meli[] = $articleMeli;
                    }
                } else {
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articleMeli === null) {
                        $articleMeli = new ArticuloMeli();
                        $articleMeli->precio = round($article->precio, 2, PHP_ROUND_HALF_UP);
                        $articleMeli->sku = $article->sku;
                        $articleMeli->id = '-1';
                        $articleMeli->marca = $article->marca;
                        $articleMeli->serie = $article->serie;
                        $articleMeli->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                    }

                    $articleMeli->cambio = 1;
                    $articleMeli->tipo_cambio = TipoCambio::NUEVO;

                    $meli[] = $articleMeli;
                    $articleMeli->save();
                }

            } catch (\Exception $e) {
                return $e;
            }
        }
        return $meli;
    }

    private function getParidad()
    {
        try {
            $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
            $client = new \SoapClient($wsdl);
            $paridad = $client->ObtenerParidad('50527', '487478');
        } catch (\Exception $e) {
            return 0;
        }

        return $paridad->datos;
    }

    private function obtenerPrecio($article, $dollarPrice)
    {
        if ($article->moneda === 'MN') {
            $precio = $article->precio;
        } else {
            $precio = $article->precio * (double)$dollarPrice;
        }

        if ($article->tipo_utilidad_ml === 1) {
            $utilidad = $article->utilidad_ml + 1;
            $precio *= $utilidad;
        } else {
            $utilidad = $article->utilidad_ml;
            $precio += $utilidad;
        }

        $precio *= 1.16;

        if ($article->comision_ml * 1 === 1) {
            if ($precio * 1 < 1001) {

                $utility = $precio * 0.13;
            } elseif ($precio * 1 < 5001) {

                $utility = (130 + (($precio - 1000) * 0.1));
            } else {

                $utility = (530 + (($precio - 5000) * 0.07));
            }
        } elseif ($article->comision_ml * 1 === 2) {
            if ($precio * 1 < 1001) {

                $utility = ($precio * 0.175);
            } elseif ($precio * 1 < 5001) {

                $utility = (175 + (($precio - 1000) * 0.145));
            } else {

                $utility = (755 + (($precio - 5000) * 0.115));
            }
        } else {
            $utility = 0;
        }

        $precio += $utility;

        return round($precio, 2, PHP_ROUND_HALF_UP);
    }

    private function compareStock($articleMeliJson, $existencia_ml)
    {
        return (int)$articleMeliJson['available_quantity'] === (int)$existencia_ml;
    }

    public function actionUpdatePrices()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;

        $dollarPrice = $this->getParidad();

        $meli = array();

        if ($request->isAjax && $request->isPost) {
            foreach ($request->bodyParams as $product) {
                $client = $this->getClient();

                $tipoOperacion = $product['tipo_cambio'];

                if ($tipoOperacion === TipoCambio::NUEVO) {
                    $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $product['sku']])->one();

                    $precio = $this->obtenerPrecio($article, $dollarPrice);

                    $json = new MeliModel();
                    $json->site_id = 'MLM';
                    if (\strlen($article->descripcion) > 60) {
                        $json->title = substr($article->descripcion, 0, 60);
                    } else {
                        $json->title = $article->descripcion;
                    }

                    $json->category_id = 'MLM57494';
                    $json->price = $precio;
                    $json->currency_id = 'MXN';
                    $json->available_quantity = 1;
                    $json->buying_mode = 'buy_it_now';
                    $json->listing_type_id = 'free';
                    $json->condition = 'new';
                    $json->status = 'paused';
                    $json->seller_custom_field = $article->sku;

                    $url = 'items';

                    $response = $client->add($url, Json::encode($json));

                    $articleMeli->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                    $articleMeli->precio = $precio;
                    $articleMeli->marca = $article->marca;
                    $articleMeli->serie = $article->serie;
                    $articleMeli->id = $response->getData()['id'];
                    $articleMeli->tipo_cambio = TipoCambio::SIN_CAMBIOS;
                    $articleMeli->cambio = 0;

                    $articleMeli->save();

                    $meli[] = $articleMeli;
                } else {
                    $meliModel = new MeliModel();
                    $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $product['sku']])->one();
                    if ($tipoOperacion === TipoCambio::INHABILITAR) {
                        $meliModel->status = 'paused';
                    } else if ($tipoOperacion === TipoCambio::HABILITAR) {
                        $meliModel->status = 'active';
                    } else if ($tipoOperacion === TipoCambio::ALTA_SISTEMA || $tipoOperacion === TipoCambio::CAMBIO_PRECIO) {
                        $precio = $this->obtenerPrecio($article, $dollarPrice);
                        $meliModel->price = $precio;
                        $articleMeli->precio = $precio;
                        $articleMeli->precio_original = round($article->precio, 2, PHP_ROUND_HALF_UP);
                    } else if ($tipoOperacion === TipoCambio::CAMBIO_CANTIDAD) {
                        if ($article->existencia_ml === 0) {
                            $meliModel->status = 'paused';
                        } else {
                            $meliModel->available_quantity = $article->existencia_ml;
                            $meliModel->status = 'active';
                        }
                    }

                    $url = 'items/' . $articleMeli->id;

                    $articleMeli->cambio = 0;
                    $articleMeli->tipo_cambio = TipoCambio::SIN_CAMBIOS;

                    $response = $client->edit($url, Json::encode($meliModel));

                    $articleMeli->save();

                    $meli[] = $articleMeli;
                }
            }
        }

        try {
            $addToTimelineCommand = new AddToTimelineCommand([
                'category' => 'meli',
                'event' => 'change',
                'data' => ['articles' => $meli]
            ]);

            Yii::$app->commandBus->handle($addToTimelineCommand);
        } catch (MissingHandlerException $igored) {
        } catch (InvalidConfigException $igored) {
        }

        return $meli;
    }

    /**
     * Lists all ArticuloMeli models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloMeliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paridad' => $this->getParidad(),
        ]);
    }

    /**
     * Displays a single ArticuloMeli model.
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
     * Finds the ArticuloMeli model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ArticuloMeli the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloMeli::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ArticuloMeli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloMeli();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticuloMeli model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ArticuloMeli model.
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

    public function actionHubMeli()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return (new Query())
            ->select(['am.sku', 'a.descripcion', 'a.precio as precio', 'am.precio_original as precio_meli', 'am.precio as precio_utilidad'])
            ->from(['tbl_articulo a', 'tbl_articulo_meli am'])
            ->where('a.sku = am.sku')
            ->all();
    }

    /**
     * @throws InvalidConfigException
     */
    public function actionHubOnlineMeli()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $formatter = \Yii::$app->formatter;

        $security = Yii::$app->getSecurity();
        $userId = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.meli.client.userid')->value), env('SECRET_KEY'));

        $client = $this->getClient();
        $url = 'users/' . $userId . '/items/search';
        $ids = implode(',', $client->get($url)->getData()['results']);

        $items = $client->get('items', ['ids=' . $ids])->getData();

        $results = array();

        foreach ($items as $item) {
            $articuloMeli = ArticuloMeli::find()->where(['id' => $item['id']])->one();

            $result = array(
                'id_meli' => $item['id'],
                'reference' => $item['seller_custom_field'],
                'price' => '$' . $formatter->asCurrency($item['price'], 'MXN'),
                'price_hub' => '$' . $formatter->asCurrency($articuloMeli['precio'], 'MXN')
            );

            $results[] = $result;
        }

        return $results;
    }

}
