<?php

namespace backend\controllers;

use common\components\keyStorage\FormModel;
use Yii;
use backend\models\search\ArticuloSearch;
use backend\models\Search\ArticuloMeliSearch;
use backend\models\Search\ArticuloPrestashopSearch;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
        return parent::beforeAction($action);
    }
    
    
    public function actionDashboard(){
        
        
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $searchModelML = new ArticuloMeliSearch();
        $dataProviderML = $searchModelML->search(Yii::$app->request->queryParams);
          
        
        $searchModelPS = new ArticuloPrestashopSearch();
        $dataProviderPS = $searchModelPS->search(Yii::$app->request->queryParams);
        
        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelML' => $searchModelML,
            'dataProviderML' => $dataProviderML,
            'searchModelPS' => $searchModelPS,
            'dataProviderPS' => $dataProviderPS
        ]);
    }

    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
                'backend.theme-skin' => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'backend.layout-fixed' => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-boxed' => [
                    'label' => Yii::t('backend', 'Boxed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-collapsed-sidebar' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }
}
