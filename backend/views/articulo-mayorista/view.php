<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayorista */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mayoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-mayorista-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sku',
            'sku_fabricante',
            'seccion',
            'linea',
            'marca',
            'serie',
            'precio',
            'alto',
            'largo',
            'ancho',
            'moneda',
            'almacen',
            'existencia',
            'disponible',
            'ultima_modificacion',
            'id_usuario_modifico',
        ],
    ]) ?>

</div>
