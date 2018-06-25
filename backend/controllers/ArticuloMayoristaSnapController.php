<?php

namespace backend\controllers;

use Yii;
use backend\models\ArticuloMayoristaSnap;
use backend\models\search\ArticuloMayoristaSnapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticuloMayoristaSnapController implements the CRUD actions for ArticuloMayoristaSnap model.
 */
class ArticuloMayoristaSnapController extends Controller
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
     * Lists all ArticuloMayoristaSnap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloMayoristaSnapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        
        $client->ObtenerListaArticulos(['cliente'=>50527,'llave'=>487478]);
        
        
        
        $wsdl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
        $client = new \SoapClient($wsdl);
        $stock = "bmi";
        //$parameters['ObtenerListaArticulos']= ['cliente'=>'50527','llave'=>'487478'];
        //
        
        $params = new \SoapVar("<cliente>50527</cliente><llave>487478</llave>", XSD_ANYXML);
        
        $values = $client->ObtenerListaArticulos($params);
        $datos = $values->datos;
        
        // $datos = json_encode($datos);
        
        //$model->data = $datos;
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticuloMayoristaSnap model.
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
     * Creates a new ArticuloMayoristaSnap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloMayoristaSnap();

        
        $client = new \mongosoft\soapclient\Client([
            'url' => 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ]);
                
        
        $client->ObtenerListaArticulos(['cliente'=>50527,'llave'=>487478]);
        
       
        
        $wsdl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
        $client = new \SoapClient($wsdl);
        $stock = "bmi";
        //$parameters['ObtenerListaArticulos']= ['cliente'=>'50527','llave'=>'487478'];
        //
        
        $params = new \SoapVar("<cliente>50527</cliente><llave>487478</llave>", XSD_ANYXML);
        
        //$values = $client->ObtenerListaArticulos($params);
       // $datos = $values->datos;
        
       // $datos = json_encode($datos);
        
        //$model->data = $datos;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticuloMayoristaSnap model.
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
     * Deletes an existing ArticuloMayoristaSnap model.
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
     * Finds the ArticuloMayoristaSnap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticuloMayoristaSnap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloMayoristaSnap::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
