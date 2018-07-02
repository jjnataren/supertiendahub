<?php

namespace backend\controllers;

use backend\models\ArticuloPrestashop;
use backend\models\ArticuloPrestashopSnap;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\Search\ArticuloPrestashopSnapSearch;
use common\models\KeyStorageItem;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticuloPrestashopSnapController implements the CRUD actions for ArticuloPrestashopSnap model.
 */
class ArticuloPrestashopSnapController extends Controller
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
        $prestashopArticles = ArticuloPrestashop::find()->all();
        ArticuloPrestashopSnap::updateAll(['actual' => 0], 'disponible = 1');
        $snapshot = new ArticuloPrestashopSnap();
        $snapshot->nombre = uniqid('SNAP_PRESTASHOP', false);
        $snapshot->fecha_creacion = date('Y-m-d H:i:s');
        $snapshot->descripcion = 'Snapshot de prestashop';
        $snapshot->data = Json::encode($prestashopArticles);
        $snapshot->disponible = 1;
        $snapshot->actual = 1;
        $snapshot->numero_registros = \count($prestashopArticles);

        $snapshot->save();

        $snapshot->data = null;
        return $snapshot;
    }

    /**
     * @return array
     * @throws \backend\models\client\PrestaShopWebserviceException
     */
    public function actionRestoreSnapshot()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = $this->getClient();
        $snap = ArticuloPrestashopSnap::find()->where(['actual' => 1])->one();
        $articles = Json::decode($snap->data);

        $articlesPrestashop = array();

        foreach ($articles as $article) {
            $articlePrestashop = ArticuloPrestashop::find()->where(['sku' => $article['sku']])->one();

            $opt = array('resource' => 'products');
            $opt['id'] = $articlePrestashop->id_prestashop;

            $xml = $client->get($opt);
            $children = $xml->children()->children();
            unset($children->manufacturer_name, $children->quantity);

            $children->price = $article['precio'];
            $articlePrestashop->precio = $article['precio'];
            $articlePrestashop->precio_original = $article['precio_original'];
            $articlePrestashop->cambio = 0;

            $opt = array('resource' => 'products');
            $opt['putXml'] = $xml->asXML();
            $opt['id'] = $articlePrestashop->id_prestashop;

            try {
                $client->edit($opt);
            } catch (PrestaShopWebserviceException $e) {
            }

            $articlePrestashop->save();

            $articlesPrestashop[] = $articlePrestashop;
        }

        return $articlesPrestashop;
    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }

    /**
     * Lists all ArticuloPrestashopSnap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloPrestashopSnapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticuloPrestashopSnap model.
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
     * Finds the ArticuloPrestashopSnap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticuloPrestashopSnap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloPrestashopSnap::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ArticuloPrestashopSnap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloPrestashopSnap();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticuloPrestashopSnap model.
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
     * Deletes an existing ArticuloPrestashopSnap model.
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
            $snapshots = ArticuloPrestashopSnap::find()->orderBy(['fecha_creacion' => SORT_DESC])->all();
            if (\count($snapshots) > 1) {
                $newsnap = $snapshots[0];
                $newsnap->actual = 1;
                $newsnap->save();
            }
        }
        return $this->redirect(['index']);
    }

}
