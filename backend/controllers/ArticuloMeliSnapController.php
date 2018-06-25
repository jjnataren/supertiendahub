<?php

namespace backend\controllers;

use backend\models\ArticuloMeli;
use backend\models\ArticuloMeliSnap;
use backend\models\search\ArticuloMeliSnapSearch;
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
}
