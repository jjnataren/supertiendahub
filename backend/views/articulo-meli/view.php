<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeli */

$this->title = $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Melis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-meli-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->sku], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->sku], [
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
            'sku',
            'id_meli',
            'marca',
            'serie',
            'precio',
            'cambio',
        ],
    ]) ?>

</div>
