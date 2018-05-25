<?php

namespace backend\controllers;

use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\ArticuloMayorista;
use Yii;
use backend\models\ArticuloPrestashop;
use backend\models\Search\ArticuloPrestashopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticuloPrestashopController implements the CRUD actions for ArticuloPrestashop model.
 */
class ArticuloPrestashopController extends Controller
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

    public function actionList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ArticuloPrestashop::find()->all();
    }

    public function actionSynchronize()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $client = new PrestashopClient('http://sevende.tv/Tienda16/prestashop', '5V9BYMW9JKEC67C6TVVTM7DGACFMJBZZ');
        $opt = array('resource' => 'products');
        $articles = ArticuloMayorista::find()->all();
        $prestashop = array();
        foreach ($articles as $article) {
            $opt['reference'] = $article->sku;
            try {
                $xml = $client->get($opt)->children();

                if ($xml->children()[0] !== null) {
                    $xml = $xml->children();
                    $id = $this->xml_attribute($xml, 'id');
                    $articlePrestashop = null;
                    if (ArticuloPrestashop::findOne($article->sku) !== null) {
                        $articlePrestashop = ArticuloPrestashop::findOne($article->sku);
                        $opt = array('resource' => 'products', 'id' => $id);
                        $articleXml = $client->get($opt);

                        if ($articlePrestashop->precio !== $articleXml->price) {
                            $articlePrestashop->cambio = 1;
                        }

                    } else {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = $id;
                        $articlePrestashop->marca = $article->marca;
                        $articlePrestashop->serie = $article->serie;
                        $articlePrestashop->cambio = 0;
                    }

                    $prestashop[] = $articlePrestashop;
                    $articlePrestashop->save();
                }

            } catch (PrestaShopWebserviceException $e) {
            }
        }

        return $prestashop;
    }

    /**
     * Lists all ArticuloPrestashop models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloPrestashopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticuloPrestashop model.
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
     * Creates a new ArticuloPrestashop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticuloPrestashop();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prestashop]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticuloPrestashop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_prestashop]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ArticuloPrestashop model.
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
     * Finds the ArticuloPrestashop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ArticuloPrestashop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticuloPrestashop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function xml_attribute($object, $attribute)
    {
        if (isset($object[$attribute])) {
            return (string)$object[$attribute];
        }
        return '';
    }

}
