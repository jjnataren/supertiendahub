<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashopSnap */

$this->title = 'Update Articulo Prestashop Snap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Prestashop Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-prestashop-snap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
