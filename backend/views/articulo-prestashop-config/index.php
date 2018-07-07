<?php


use backend\assets\SwalAsset;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;

$this->title = 'Articulo Prestashop Configuraci&oacute;n';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';

SwalAsset::register($this);
$this->registerJsFile('@web/js/swalalert.js', ['depends' => [\yii\web\YiiAsset::class]]);

/* @var $searchModel backend\models\search\KeyStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-wrench"></i>
                <h3 class="box-title">Actualizaci&oacute;n de par&aacute;metros de configuraci&oacute;n</h3>
            </div>
            <div class="box-body">
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

                            [
                                'class' => ActionColumn::class,
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<i class="fa fa-pencil"></i> Editar', ['articulo-prestashop-config/update', 'id' => $model->key],
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
                    echo 'No se pudo obtener la tabla: ', $e;
                } ?>
            </div>
        </div>
    </div>
</div>
