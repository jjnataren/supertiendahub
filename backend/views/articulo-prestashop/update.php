<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashop */

$this->title = 'Update Articulo Prestashop: ' . ' ' . $model->id_prestashop;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Prestashops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestashop, 'url' => ['view', 'id' => $model->id_prestashop]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-prestashop-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
