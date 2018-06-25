<?php

namespace backend\controllers;

use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\Search\ArticuloPrestashopSearch;
use backend\models\search\ArticuloSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticuloPrestashopController implements the CRUD actions for ArticuloPrestashop model.
 */
class ArticuloPrestashopController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
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
        $articles = Articulo::find()->all();
        $prestashop = array();

        foreach ($articles as $article) {
            try {
                $opt = array('resource' => 'products');
                $opt['filter[reference]'] = $article->sku;
                $xml = $client->get($opt)->children();

                if ($xml->children()[0] !== null) {
                    $xml = $xml->children();
                    $id = $this->xml_attribute($xml->attributes(), 'id');
                    $articlePrestashop = null;

                    $optArticle = array('resource' => 'products', 'id' => $id);
                    $articleXml = $client->get($optArticle)->product;

                    $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $article->sku])->one();
                    if ($articlePrestashop !== null) {
                        if (number_format($article->precio, 3) !== number_format($articlePrestashop->precio_original, 3)) {
                            $articlePrestashop->cambio = 1;
                            $prestashop[] = $articlePrestashop;
                            $articlePrestashop->save();
                        } else if ($articlePrestashop->cambio === 1) {
                            $prestashop[] = $articlePrestashop;
                        }
                    } else {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = $id;
                        $articlePrestashop->marca = $article->marca;
                        $articlePrestashop->serie = $article->serie;
                        $articlePrestashop->cambio = 1;
                        $articlePrestashop->precio = (double)$articleXml->price;
                        $articlePrestashop->precio_original = $article->precio;
                        $prestashop[] = $articlePrestashop;
                        $articlePrestashop->save();
                    }
                }
            } catch (PrestaShopWebserviceException $e) {
            }
        }
        return $prestashop;
    }

    public function actionUpdatePrices()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;

        $wsdl = 'http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl';
        $soapClient = new \SoapClient($wsdl);
        $paridad = $soapClient->ObtenerParidad('50527', '487478');
        $dollarPrice = $paridad->datos;

        $prestashop = array();

        if ($request->isAjax && $request->isPost) {
            foreach ($request->bodyParams as $product) {
                $client = new PrestashopClient('http://sevende.tv/Tienda16/prestashop', '5V9BYMW9JKEC67C6TVVTM7DGACFMJBZZ');

                $opt = array('resource' => 'products');
                $opt['id'] = $product['id_prestashop'];

                try {
                    $article = ArticuloSearch::find()->where(['sku' => $product['sku']])->one();
                    $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $product['sku']])->one();
                    $xml = $client->get($opt);
                    $children = $xml->children()->children();
                    unset($children->manufacturer_name, $children->quantity);


                    if ($article->moneda === 'MN') {
                        $precio = $article->precio;
                    } else {
                        $precio = $article->precio * (double)$dollarPrice;
                    }

                    if ($article->tipo_utilidad_ps === 1) {
                        $utilidad = ($article->utilidad_ps / 100) + 1;
                        $precio *= $utilidad;
                    } else {
                        $utilidad = $article->utilidad_ps;
                        $precio += $utilidad;
                    }

                    $children->price = $precio;
                    $articlePrestashop->precio = $precio;
                    $articlePrestashop->precio_original = $article->precio;
                    $articlePrestashop->cambio = 0;

                    $opt = array('resource' => 'products');
                    $opt['putXml'] = $xml->asXML();
                    $opt['id'] = $product['id_prestashop'];

                    try {
                        $client->edit($opt);
                    } catch (PrestaShopWebserviceException $e) {
                    }

                    $articlePrestashop->save();

                    $prestashop[] = $articlePrestashop;
                } catch (PrestaShopWebserviceException $e) {
                    return $e;
                }
            }
        }

        return $prestashop;
    }

    /**
     * Lists all PS Items throught partial render view
     * @return string
     * @throws PrestaShopWebserviceException
     */
    public function actionGetItemsView()
    {

        $client = new PrestashopClient('http://sevende.tv/Tienda16/prestashop', '5V9BYMW9JKEC67C6TVVTM7DGACFMJBZZ');


        try {

            $xml = $client->get(['resource' => 'products',
                'display' => '[id,name, description,reference,price,quantity]'
            ]);

            $items = json_decode(json_encode((array)$xml)
                , TRUE)
            ['products']['product'];

        } catch (PrestaShopWebserviceException $e) {
            throw $e;
        }

        return $this->renderPartial('_get_items_view', ['items' => $items]);
    }

    /**
     * Lists all ArticuloPrestashop models.
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

        $searchModel = new ArticuloPrestashopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paridad' => $paridad->datos,
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
