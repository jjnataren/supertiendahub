<?php

namespace backend\controllers;

use backend\models\ArticuloPrestashop;
use Yii;
use backend\models\ArticuloPrestashopSnap;
use backend\models\Search\ArticuloPrestashopSnapSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionCreateSnapshot() {
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
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticuloPrestashopSnap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticuloPrestashopSnap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
