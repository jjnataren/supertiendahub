<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticuloSnapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Snaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-snap-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Articulo Snap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_creacion',
            'nombre',
            'descripcion',
            'data:ntext',
            // 'disponible',
            // 'actual',
            // 'numero_registros',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
