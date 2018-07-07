<?php

use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use backend\assets\SwalAsset;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KeyStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuracion temporizador PHC Mayoristas';
$this->params['breadcrumbs'][] = $this->title;

SwalAsset::register($this);
$this->registerJsFile('@web/js/swalalert.js', ['depends' => [\yii\web\YiiAsset::class]]);
?>
<div class="row">

    <div class="col-md-12 col-xs-12 col-sm-12">


        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'columns' => [
                    ['class' => SerialColumn::class],

                    'comment',
                    'value',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                //Html::a('borrar', ['cuota-taller/delete','id'=>$key], ['class' => 'bg-red label']);
                                return Html::a('<i class="fa fa-pencil"></i> Editar', ['articulo-mayorista/update-config', 'id' => $model->key],
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
            ]);
        } catch (Exception $e) {
            echo 'No se pudo obtener datos';
        } ?>

    </div>
</div>