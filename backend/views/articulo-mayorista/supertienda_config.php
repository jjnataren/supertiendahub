<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KeyStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuracion temporizador PHC Mayoristas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

<div class="col-md-12 col-xs-12 col-sm-12">


    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'comment',
            'value',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons' => [
    
                    'update' => function ($url, $model, $key) {
                    //Html::a('borrar', ['cuota-taller/delete','id'=>$key], ['class' => 'bg-red label']);
                            return Html::a('<i class="fa fa-pencil"></i> Editar', ['articulo-mayorista/update-config', 'id'=>$model->key],
                            [
                            'class' => 'btn btn-primary',
                            'data-pjax' => '0',
                            'data' => [
                            'confirm' => 'Tenga cuidado al actualizar los datos de configuración',
                            'method' => 'post',
                            ]
                            ]);
                    }
                    ]
            ],
        ],
    ]); ?>

</div>
</div>