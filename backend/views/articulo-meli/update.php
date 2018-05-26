<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeli */

$this->title = 'Update Articulo Meli: ' . ' ' . $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Melis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku, 'url' => ['view', 'id' => $model->sku]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-meli-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
