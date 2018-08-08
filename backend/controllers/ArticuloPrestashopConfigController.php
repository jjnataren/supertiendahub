<?php

namespace backend\controllers;

use backend\models\client\PrestashopClient;
use backend\models\search\KeyStorageItemSearch;
use common\models\KeyStorageItem;
use Intervention\Image\Exception\NotFoundException;
use Yii;

class ArticuloPrestashopConfigController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new KeyStorageItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['key' => SORT_DESC]
        ];
        $dataProvider->query->andWhere(['like', 'key', 'config.prestashop']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model !== null && $model->load(Yii::$app->request->post())) {
            $value = $model->value;
            $model->value = base64_encode(Yii::$app->getSecurity()->encryptByKey($value, env('SECRET_KEY')));

            $model->save();

            return $this->redirect('index');
        }

        $value = $model->value;
        $model->value = Yii::$app->getSecurity()->decryptByKey(base64_decode($value), env('SECRET_KEY'));

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    protected function findModel($id)
    {
        if (($model = KeyStorageItem::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }

    public function actionProofService()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $client = $this->getClient();
        return $client->checkStatus();
    }

    private function getClient()
    {
        $security = Yii::$app->getSecurity();
        $apiUrl = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));
        $key = $security->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.password')->value), env('SECRET_KEY'));
        return new PrestashopClient($apiUrl, $key);
    }

}
