<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloMeli;
use backend\models\client\MeliOAuth2Client;
use backend\models\MeliModel;
use backend\models\search\ArticuloMeliSearch;
use backend\models\search\ArticuloSearch;
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
            $url = 'users/215058471/items/search';
            $articlesMeli = $client->get($url)->getData()['results'];


            foreach ($articlesMeli as $key => $value) {

                $url = 'items/' . $value;

                $items[$value] = $client->get($url)->getData();

            }


        } catch (\Exception $e) {
        }


        return $this->renderPartial('_get_items_view', ['items' => $items]);

    }


    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = $this->getClient();

        $articles = Articulo::find()->all();

        $meli = array();

        foreach ($articles as $article) {
            try {
                $url = 'users/215058471/items/search';
                $articlesMeli = $client->get($url, ['sku=' . $article->sku])->getData()['results'];

                if (\count($articlesMeli) > 0) {
                    $url = 'items/' . $articlesMeli[0];
                    $articleMeliJson = $client->get($url)->getData();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articleMeli !== null) {
                        if (number_format($article->precio, 3) !== number_format($articleMeli->precio_original, 3)) {
                            $articleMeli->cambio = 1;
                            $meli[] = $articleMeli;
                            $articleMeli->save();
                        } else if ($articleMeli->cambio === 1) {
                            $meli[] = $articleMeli;
                        }
                    } else {
                        $articleMeli = new ArticuloMeli();
                        $articleMeli->precio = $articleMeliJson['price'];
                        $articleMeli->sku = $article->sku;
                        $articleMeli->id = $articlesMeli[0];
                        $articleMeli->marca = $article->marca;
                        $articleMeli->serie = $article->serie;
                        $articleMeli->precio_original = $article->precio;
                        $articleMeli->cambio = 1;

                        $articleMeli->save();

                        $meli[] = $articleMeli;
                    }
                }

            } catch (\Exception $e) {
            }
        }
        return $meli;
    }

    public function actionUpdatePrices()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;

        $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
        $soapClient = new \SoapClient($wsdl);

        try {
            $paridad = $soapClient->ObtenerParidad('50527', '487478');
            $dollarPrice = $paridad->datos;
        } catch (\Exception $e) {
            $dollarPrice = 0;
        }

        $meli = array();

        if ($request->isAjax && $request->isPost) {
            foreach ($request->bodyParams as $product) {
                $client = $this->getClient();

                try {
                    $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $product['sku']])->one();

                    $url = 'items/' . $articleMeli->id;

                    $meliModel = new MeliModel();

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

                    $meliModel->price = $precio;

                    $articleMeli->precio = $precio;
                    $articleMeli->precio_original = $article->precio;
                    $articleMeli->cambio = 0;

                    $client->edit($url, Json::encode($meliModel));

                    $articleMeli->save();

                    $meli[] = $articleMeli;
                } catch (\Exception $e) {
                    return $e;
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

        try {
            $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
            $client = new \SoapClient($wsdl);
            $paridad = $client->ObtenerParidad('50527', '487478');
        } catch (\Exception $e) {
            $paridad = 0;
        }

        $searchModel = new ArticuloMeliSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paridad' => $paridad->datos,
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
     * @throws PrestaShopWebserviceException
     * @throws InvalidConfigException
     */
    public function actionHubOnlineMeli()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $formatter = \Yii::$app->formatter;

        $client = $this->getClient();
        $url = 'users/215058471/items/search';
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
