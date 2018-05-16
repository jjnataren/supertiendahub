<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticuloMayoristaSnapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Mayorista Snaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-mayorista-snap-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Articulo Mayorista Snap', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
