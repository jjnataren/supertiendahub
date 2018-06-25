<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayorista */

$this->title = 'Actualizar artículo: ' . ' ' . $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mayoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku, 'url' => ['view', 'id' => $model->sku]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="articulo-mayorista-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
