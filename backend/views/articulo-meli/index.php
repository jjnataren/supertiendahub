<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ArticuloMeliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Melis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-meli-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Articulo Meli', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sku',
            'id_meli',
            'marca',
            'serie',
            'precio',
            // 'cambio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
