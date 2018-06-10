<?php

namespace backend\controllers;

use backend\models\ArticuloMayorista;
use backend\models\client\MeliOAuth2Client;
use backend\models\MeliModel;
use backend\models\search\ArticuloMayoristaSearch;
use Yii;
use backend\models\ArticuloMeli;
use backend\models\Search\ArticuloMeliSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Lists all ML Items throught partial render view
     * @return \yii\db\ActiveRecord[]|array[]|NULL[]
     */
    public function actionGetItemsView()
    {
        
        $client = new MeliOAuth2Client();
        $client->clientSecret = 'xajs1DIwU0qviWiR5qtujz10Mc3XVST4';
        $client->clientId = '1018511717969029';
        $client->tokenUrl = 'https://api.mercadolibre.com/oauth/token';
        $client->apiBaseUrl = 'https://api.mercadolibre.com/';
        $client->userId = '215058471';
        
        $client->authenticateClient();
        
        $articles = ArticuloMayorista::find()->all();
        
        $meli = array();
        
        $items = [];
      
            try
            {
                $url = 'users/215058471/items/search';
                $articlesMeli = $client->get($url)->getData()['results'];
                
                                
                foreach ($articlesMeli as $key=>$value ){
                    
                    $url = 'items/'.$value;
                    
                    $items[$value] = $client->get($url)->getData();
                    
                }
                    
                
                
                
                
            } catch (\Exception $e) {
            }
        
            
            
            return $this->renderPartial('_get_items_view',['items'=> $items]);
            
    }
    
    
    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = new MeliOAuth2Client();
        $client->clientSecret = 'xajs1DIwU0qviWiR5qtujz10Mc3XVST4';
        $client->clientId = '1018511717969029';
        $client->tokenUrl = 'https://api.mercadolibre.com/oauth/token';
        $client->apiBaseUrl = 'https://api.mercadolibre.com/';
        $client->userId = '215058471';

        $client->authenticateClient();

        $articles = ArticuloMayorista::find()->all();

        $meli = array();

        foreach ($articles as $article)
        {
            try
            {
                $url = 'users/215058471/items/search';
                $articlesMeli = $client->get($url, ['sku=' . $article->sku])->getData()['results'];

                if (\count($articlesMeli) > 0)
                {
                    $url = 'items/' . $articlesMeli[0];
                    $articleMeliJson = $client->get($url)->getData();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $article->sku])->one();

                    if ($articleMeli !== null)
                    {
                        if ($article->precio !== (double)$articleMeliJson['price'])
                        {
                            $articleMeli->cambio = 1;
                            $meli[] = $articleMeli;
                        }
                    } else
                    {
                        $articleMeli = new ArticuloMeli();
                        $articleMeli->precio = $articleMeliJson['price'];
                        $articleMeli->sku = $article->sku;
                        $articleMeli->id_meli = $articlesMeli[0];
                        $articleMeli->marca = $article->marca;
                        $articleMeli->serie = $article->serie;
                        $articleMeli->cambio = 0;
                    }

                    $articleMeli->save();
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

        if ($request->isAjax && $request->isPost)
        {
            foreach ($request->bodyParams as $product)
            {
                $client = new MeliOAuth2Client();
                $client->clientSecret = 'xajs1DIwU0qviWiR5qtujz10Mc3XVST4';
                $client->clientId = '1018511717969029';
                $client->tokenUrl = 'https://api.mercadolibre.com/oauth/token';
                $client->apiBaseUrl = 'https://api.mercadolibre.com/';
                $client->userId = '215058471';

                $client->authenticateClient();

                try {
                    $article = ArticuloMayoristaSearch::find()->where(['sku' => $product['sku']])->one();
                    $articleMeli = ArticuloMeliSearch::find()->where(['sku' => $product['sku']])->one();

                    $url = 'items/' . $articleMeli->id_meli;

                    $meliModel = new MeliModel();
                    $meliModel->price = $article->precio;

                    $articleMeli->precio = $article->precio;
                    $articleMeli->cambio = 0;

                    $client->edit($url, Json::encode($meliModel));

                    $articleMeli->save();
                } catch (\Exception $e) {
                    return $e;
                }
            }
        }

        return 'ok';
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
        ]);
    }

    /**
     * Displays a single ArticuloMeli model.
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
     * Creates a new ArticuloMeli model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloMeli();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sku]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticuloMeli model.
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
     * Deletes an existing ArticuloMeli model.
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
