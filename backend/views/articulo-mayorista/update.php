<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayorista */

$this->title = 'Update Articulo Mayorista: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mayoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-mayorista-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
