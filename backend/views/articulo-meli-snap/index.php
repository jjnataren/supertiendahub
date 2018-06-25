<?php

use backend\assets\SwalAsset;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticuloMeliSnapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Mercado Libre Snaps';
$this->params['breadcrumbs'][] = $this->title;

SwalAsset::register($this);

$this->registerJsFile('@web/js/swalalert.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/meli.snap.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="articulo-meli-snap-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo Html::button('Generar Snapshot', ['class' => 'btn btn-primary', 'id' => 'snapshot_button']) ?>

    <?php Pjax::begin(['id' => 'meli_snap']) ?>
    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
        echo 'No se pudo obtener los resultados.';
    } ?>
    <?php Pjax::end() ?>

</div>
