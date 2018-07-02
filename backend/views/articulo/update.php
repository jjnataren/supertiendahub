<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Articulo */

$this->title = 'Actualizar articulo: ' . ' ' . $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku, 'url' => ['view', 'id' => $model->sku]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
