<?php

namespace backend\controllers;

use backend\models\ArticuloMeli;
use backend\models\ArticuloMeliSnap;
use backend\models\client\MeliOAuth2Client;
use backend\models\MeliModel;
use backend\models\Search\ArticuloMeliSearch;
use backend\models\search\ArticuloMeliSnapSearch;
use common\models\KeyStorageItem;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticuloMeliSnapController implements the CRUD actions for ArticuloMeliSnap model.
 */
class ArticuloMeliSnapController extends Controller
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

    public function actionCreateSnapshot()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $meliArticles = ArticuloMeli::find()->all();
        ArticuloMeliSnap::updateAll(['actual' => 0], 'disponible = 1');
        $snapshot = new ArticuloMeliSnap();
        $snapshot->nombre = uniqid('SNAP_MELI', false);
        $snapshot->fecha_creacion = date('Y-m-d H:i:s');
        $snapshot->descripcion = 'Snapshot de mercado libre';
        $snapshot->data = Json::encode($meliArticles);
        $snapshot->disponible = 1;
        $snapshot->actual = 1;
        $snapshot->numero_registros = \count($meliArticles);

        $snapshot->save();

        $snapshot->data = null;
        return $snapshot;
    }

    public function actionRestoreSnapshot()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = $this->getClient();
        $snap = ArticuloMeliSnap::find()->where(['actual' => 1])->one();
        $articles = Json::decode($snap->data);

        $articlesMeli = array();

        foreach ($articles as $article) {
            $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $article['sku']])->one();
            $meliModel = new MeliModel();

            $articleMeli->precio = $article['precio'];
            $articleMeli->precio_original = $article['precio_original'];
            $articleMeli->cambio = 0;

            $meliModel->price = $article['precio'];

            $url = 'items/' . $articleMeli->id;
            $client->edit($url, Json::encode($meliModel));

            $articleMeli->save();

            $articlesMeli[] = $articleMeli;
        }

        return $articlesMeli;
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

    /**
     * Lists all ArticuloMeliSnap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloMeliSnapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticuloMeliSnap model.
     * @param integer $id
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
     * Finds the ArticuloMeliSnap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticuloMeliSnap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloMeliSnap::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ArticuloMeliSnap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloMeliSnap();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticuloMeliSnap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ArticuloMeliSnap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $snapshot = $this->findModel($id);

        $snapshot->delete();

        if ($snapshot->actual === 1) {
            $snapshots = ArticuloMeliSnap::find()->orderBy(['fecha_creacion' => SORT_DESC])->all();
            if (\count($snapshots) > 1) {
                $newsnap = $snapshots[0];
                $newsnap->actual = 1;
                $newsnap->save();
            }
        }

        return $this->redirect(['index']);
    }

}
