<?php

namespace backend\controllers;

use Yii;
use backend\models\Articulo;
use backend\models\search\ArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticuloController implements the CRUD actions for Articulo model.
 */
class ArticuloController extends Controller
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
     * Lists all Articulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articulo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articulo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Articulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Articulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    /**
     * Performs a soap call to PHC Mayoristas.
     * @return mixed
     */
    public function actionSyncPhcResume(){
        
        //TODO: Build a common SOAP Client for PHC .
        //TODO: Get soap body params by environment vars .
        $wsdl =
        \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8088/servidor.php?wsdl');
        $params = "<cliente>50527</cliente><llave>487478</llave>";
        
        $client = new \SoapClient($wsdl);
        $soap_response = $client->ObtenerListaArticulos(new \SoapVar($params, XSD_ANYXML))->datos;
        //TODO: Optimize search proccess
        
        $paridad = $client->ObtenerParidad(new \SoapVar($params, XSD_ANYXML))->datos;
        
        
        if (Yii::$app->request->post()) {
            
            $model = new Articulo();
            
            $model->load( Yii::$app->request->post() );
            
            $model =  Articulo::findOne($model->sku);
            
            if (!$model)
                $model = new Articulo();
                
                $model->load( Yii::$app->request->post());
                
                if (!$model->save() ) {
                    
                    throw new NotFoundHttpException('Error al guardar');
                }
                
                
        }
        
        $articles = [];
        
        
        $filter =   Yii::$app->request->get('filter');
        
        
        $articlesModel = Articulo::find()->all();
        
        
        
        
        
        
        foreach ($articlesModel as $dbModel){
            
            
            $objectModel = null;
            
            foreach ($soap_response as $object){
                
                if(isset($object->sku) &&  $object->sku == $dbModel->sku){
                    
                    $objectModel = $object;
                    break;
                }
                
                
            }
            
            
            if ($objectModel){
                        
            $model =  new Articulo();
            
            $model->attributes = get_object_vars($objectModel);
            }else{
                
              $model = null;  
            }
            
            if(  !$model || $dbModel->precio*1 !==  $model->precio*1)
                $articles[$dbModel->sku] = ['dbmodel'=>$dbModel, 'model'=>$model];
        }
        
        
        if (Yii::$app->request->get('dashboard')!== null &&  Yii::$app->request->get('dashboard'))
            return $this->renderPartial('_sync_phc',['articles'=> $articles,'filter'=>$filter,'paridad'=>$paridad]);
            
            return $this->renderPartial('_sync_phc_resume',['articles'=> $articles,'filter'=>$filter,'paridad'=>$paridad]);
    }
    
    
    /**
     * Finds the Articulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Articulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
