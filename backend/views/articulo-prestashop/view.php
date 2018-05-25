<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashop */

$this->title = $model->id_prestashop;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Prestashops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-prestashop-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id_prestashop], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id_prestashop], [
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
            'id_prestashop',
            'marca',
            'serie',
            'precio',
        ],
    ]) ?>

</div>
