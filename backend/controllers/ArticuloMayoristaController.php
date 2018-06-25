<?php

namespace backend\controllers;

use Yii;
use backend\models\ArticuloMayorista;
use backend\models\search\ArticuloMayoristaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ArticuloMayoristaSnap;
use backend\models\search\ArticuloMayoristaSnapSearch;
use backend\models\search\KeyStorageItemSearch;
use common\models\KeyStorageItem;

/**
 * ArticuloMayoristaController implements the CRUD actions for ArticuloMayorista model.
 */
class ArticuloMayoristaController extends Controller
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
     * Updates an existing KeyStorageItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateConfig($id)
    {
        
        
        if (($model = KeyStorageItem::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['super-tienda-config']);
        } else {
            return $this->render('update_config', [
                'model' => $model,
            ]);
        }
    }
    
    
    
    /**
     * Gets paridad dollar from PHC Mayoristas
     * @return mixed
     */
    public function actionGetParidad()
    {
        
        $wsdl =
        \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8088/servidor.php?wsdl');
        
        $cliente = 
        \Yii::$app->keyStorage->get('config.phc.webservice.cliente', '50527');
        
        $llave =
        \Yii::$app->keyStorage->get('config.phc.webservice.llave', '487478');
        
        $params = "<cliente>$cliente</cliente><llave>$llave</llave>";
        
        $client = new \SoapClient($wsdl);
        //$valores = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;
    
        return json_encode( $client->ObtenerParidad(new \SoapVar($params, XSD_ANYXML))->datos );
        
    }
    
    
    /**
     * Performs a soap call to PHC Mayoristas.
     * @return mixed
     */
    public function actionSoapReq(){
        
        //TODO: Build a common SOAP Client for PHC .
        //TODO: Get soap body params by environment vars .
        $wsdl = 
        \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8088/servidor.php?wsdl');
        
        
        $params = "<cliente>50527</cliente><llave>487478</llave>";
        $client = new \SoapClient($wsdl);        
        //$valores = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;
        
        $soap = $client->ObtenerListaArticulos( new \SoapVar($params, XSD_ANYXML));
        
        return $this->renderPartial('_phc_mayorista_response',['soap_response'=> $soap->datos]);
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
        $soap_response = $client->ObtenerListaArticulos( new \SoapVar($params, XSD_ANYXML))->datos;
        //TODO: Optimize search proccess 
        
        $paridad = $client->ObtenerParidad(new \SoapVar($params, XSD_ANYXML))->datos;
        
        
        if (Yii::$app->request->post()) {
            
            $model = new ArticuloMayorista();
            
            $model->load( Yii::$app->request->post() );
            
            $model =  ArticuloMayorista::findOne($model->sku);
            
            if (!$model)
                $model = new ArticuloMayorista();
            
            $model->load( Yii::$app->request->post());
            
            if (!$model->save() ) {
                
                throw new NotFoundHttpException('Error al guardar');
            }
            
           
        } 
        
        $articles = [];
        
        
        $filter =   Yii::$app->request->get('filter');
        
        foreach ($soap_response as $articulo){
            
            $model =  new ArticuloMayorista();
            $model->attributes = get_object_vars($articulo);
            
            $dbModel = ArticuloMayorista::findOne($model->sku);
     
                            
                    if(  !$dbModel || $dbModel->precio*1 !==  $model->precio*1)
                        $articles[$model->sku] = ['dbmodel'=>$dbModel, 'model'=>$model];
        }
        
        
        if (Yii::$app->request->get('dashboard')!== null &&  Yii::$app->request->get('dashboard'))
            return $this->renderPartial('_sync_phc',['articles'=> $articles,'filter'=>$filter,'paridad'=>$paridad]);
        
        return $this->renderPartial('_sync_phc_resume',['articles'=> $articles,'filter'=>$filter,'paridad'=>$paridad]);
    }
    
    
    
    
    
    
    
    
    /**
     * Lists all KeyStorageItem models.
     * @return mixed
     */
    public function actionSuperTiendaConfig()
    {
        $searchModel = new KeyStorageItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['key' => SORT_DESC]
        ];
        $dataProvider->query->andWhere('`key` like "config.phc%"');
        
        return $this->render('supertienda_config', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    
    
    
    /**
     * Lists all ArticuloMayorista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloMayoristaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $searchSnapModel = new ArticuloMayoristaSnapSearch();
        $snapDataProvider = $searchSnapModel->search(Yii::$app->request->queryParams);
     
        $soap_response = [];
            
         return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'soap_response' =>$soap_response,
            'searchSnapModel'=>$searchSnapModel,
            'snapDataProvider'=>$snapDataProvider
        ]);
    }
    
    
    
    /**
     * Imports set of articles to dw.
     * @return mixed
     */
    public function actionGenerateSnap(){
        
        if (Yii::$app->request->post()){
            
            //TODO: Build a common SOAP Client for PHC .
           // $wsdl = "http://localhost:8088/servidor.php?wsdl";
           // $client = new \SoapClient($wsdl);
            
          //  $soap_response = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;
        
                $articles = ArticuloMayorista::findBySql('select * from tbl_articulo_mayorista')->all();
                
                $soap_response = [];
                foreach ($articles as $article){
                    
                    $soap_response[] = $article->attributes;
                    
                }
            
                ArticuloMayoristaSnap::updateAll(['actual'=>0]);
                
                $snapModel = new ArticuloMayoristaSnap();
                $snapModel->fecha_creacion =date ('Y-m-d H:i:s');
                $snapModel->nombre = 'PHC'.date('YmdHis');
                $snapModel->data = json_encode($soap_response);
                $snapModel->actual = true;
                $snapModel->disponible = true;
                $snapModel->numero_registros = count($soap_response);
                
                
                
                if($snapModel->save())
                    Yii::$app->session->setFlash('alert', [
                        'options' => ['class' => 'alert-success'],
                        'body' => 'Se ha generado una nueva imagen <i class="fa fa-camera">  '.$snapModel->nombre.'</i> de articulos.'
                    ]);else
                    Yii::$app->session->setFlash('alert', [
                        'options' => ['class' => 'alert-danger'],
                        'body' => 'No fue posible genera la imagen, intente mas tarde.'
                    ]);
                    
                //TODO: builds a particular alert into main menu                   
                
                
                
                return $this->redirect(['index']);
            
        }
        
    }
    
    
    /**
     * Sets a SNAPSHOT as current to compare to
     */
    public function actionSelectSnap(){
        
        if (Yii::$app->request->get()){
            
            $id = Yii::$app->request->get('id');
            
            $transaction = ArticuloMayoristaSnap::getDb()->beginTransaction();
           
            try {
            
            ArticuloMayoristaSnap::updateAll(['actual'=>false]);
            
            $model = ArticuloMayoristaSnap::findOne($id);
            
            $model->actual = true;
            
            $model->save();
            
            ArticuloMayorista::deleteAll();
            
            $soap_response = json_decode( $model->data);
            
            
            foreach ($soap_response as $articulo){
                
                $articuloModel =  new ArticuloMayorista();
                
                $articuloModel->attributes = get_object_vars($articulo);
                
                $articuloModel->save();
                
            }
            
            $transaction->commit();
            
            
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => ' Se ha seleccionado la imagen <i class="fa fa-camera">    '.$model->nombre.'</i> como actual.'
            ]);
            
            } catch(\Exception $e) {
                $transaction->rollBack();
                
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class' => 'alert-danger'],
                    'body' => 'No se ha podido establecer la imagen deseada '
                ]);
                
            } catch(\Throwable $e) {
                $transaction->rollBack();
                
                Yii::$app->session->setFlash('alert', [
                    'options' => ['class' => 'alert-danger'],
                    'body' => 'No se ha podido establecer la imagen deseada '
                ]);
            }
        
        }
        
        return $this->redirect(['index']);
    
    }
    
    
    
    /**
     * Imports set of articles to dw.
     * @return mixed
     */
    public function actionImport(){
        
        if (Yii::$app->request->post()){
            
            //TODO: Build a common SOAP Client for PHC .
            $wsdl = "http://localhost:8088/servidor.php?wsdl";
            $client = new \SoapClient($wsdl);
       
            
            $soap_response = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;
            
        
            
            $transaction = ArticuloMayoristaSnap::getDb()->beginTransaction();
            try {
                
                
                
                $articles = ArticuloMayorista::findBySql('select * from tbl_articulo_mayorista')->all();
                
                $currentSnap = [];
                foreach ($articles as $article){
                    
                    $currentSnap[] = $article->attributes;
                    
                }
                
               
                
                $snapModelCurrent = new ArticuloMayoristaSnap();
                $snapModelCurrent->fecha_creacion =date ('Y-m-d H:i:s');
                $snapModelCurrent->nombre = 'PHC'.date('YmdHis');
                $snapModelCurrent->data = json_encode($currentSnap);
                $snapModelCurrent->actual = 0;
                $snapModelCurrent->disponible = true;
                $snapModelCurrent->numero_registros = count($currentSnap);
                $snapModelCurrent->save();
                
                sleep(2);
                
                ArticuloMayoristaSnap::updateAll(['actual'=>0]);
                
                $snapModel = new ArticuloMayoristaSnap();
                $snapModel->fecha_creacion =date ('Y-m-d H:i:s');
                $snapModel->nombre = 'PHC'.date('YmdHis');
                $snapModel->data = json_encode($soap_response);
                $snapModel->actual = true;
                $snapModel->disponible = true;
                $snapModel->numero_registros = count($soap_response);
                $snapModel->save();
                
                ArticuloMayorista::deleteAll();
                
                foreach ($soap_response as $articulo){
                    
                    $model =  new ArticuloMayorista();
                    $model->attributes = get_object_vars($articulo);
                    $model->save();
                   
                }
                
                Yii::$app->getSession()->setFlash('success', [
                    'body'=>'Se ha guardado una nueva imagen del estado actual [ '.$snapModel->nombre.' ] ',
                    'options'=>['class'=>'alert-success']
                ]);
                
                Yii::$app->getSession()->setFlash('success', [
                    'body'=>'Se han importado '.count($soap_response).' articulos correctamente a SUPERTIENDA HUB',
                    'options'=>['class'=>'alert-success']
                ]);
                
                Yii::$app->getSession()->setFlash('success', [
                    'body'=>'Se ha generado una nueva imagen con los articulos importados [ '.$snapModel->nombre.' ] ',
                    'options'=>['class'=>'alert-success']
                ]);
                
                
                
                $transaction->commit();
                
                
                
            } catch(\Exception $e) {
                $transaction->rollBack();
               
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>'Ha ocurrido un error al importar los datos de PHC Mayoristas <b /> Detalle: '.$e->getMessage(),
                    'options'=>['class'=>'alert-danger']
                ]);
                
            } catch(\Throwable $e) {
                $transaction->rollBack();
                
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>'Ha ocurrido un error al importar los datos de PHC Mayoristas <b /> Detalle: '.$e->getMessage(),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
            
            
            return $this->redirect(['index']);
        }
        
    }
    
    /**
     * Lists all ArticuloMayorista models.
     * @return mixed
     */
    public function actionIndexTienda()
    {
        $searchModel = new ArticuloMayoristaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index-tienda', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           
            
        ]);
    }

    /**
     * Displays a single ArticuloMayorista model.
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
     * Creates a new ArticuloMayorista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloMayorista();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticuloMayorista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => ' Se ha actualizado el artículo ['.$model->sku.'] correctamente.'
            ]);
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticuloMayorista model.
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
     * Finds the ArticuloMayorista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticuloMayorista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloMayorista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
