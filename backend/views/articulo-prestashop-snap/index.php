<?php

use backend\assets\SwalAsset;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ArticuloPrestashopSnapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Prestashop Snaps';
$this->params['breadcrumbs'][] = $this->title;

SwalAsset::register($this);

$this->registerJsFile('@web/js/swalalert.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/prestashop.snap.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<div class="articulo-prestashop-snap-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="btn-group">
        <?php echo Html::button('Generar Snapshot', ['class' => 'btn btn-primary', 'id' => 'snapshot_button']) ?>
        <?php echo Html::button('Restaurar Snapshot', ['class' => 'btn btn-warning', 'id' => 'snapshot_restore_button']) ?>
    </div>

    <?php Pjax::begin(['id' => 'prestashop_snap']) ?>
    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'grid-view table-responsive'
            ],
            'columns' => [
                ['class' => SerialColumn::class],

                'id',
                'fecha_creacion',
                'nombre',
                'descripcion',
                // 'data:ntext',
                // 'disponible',
                // 'actual',
                // 'numero_registros',

                ['class' => ActionColumn::class],
            ],
        ]);
    } catch (Exception $e) {
        echo 'No se pudo mostrar la tabla.';
    } ?>
    <?php Pjax::end() ?>

</div>
