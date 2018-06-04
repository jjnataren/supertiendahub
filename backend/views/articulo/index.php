<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Articulo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sku',
            'descripcion',
            'sku_fabricante',
            'seccion',
            'linea',
            // 'marca',
            // 'serie',
            // 'precio',
            // 'peso',
            // 'alto',
            // 'largo',
            // 'ancho',
            // 'moneda',
            // 'almacen',
            // 'existencia',
            // 'disponible',
            // 'ultima_modificacion',
            // 'id_usuario_modifico',
            // 'id_snap',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
