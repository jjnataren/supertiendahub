<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayoristaSnap */

$this->title = 'Update Articulo Mayorista Snap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mayorista Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-mayorista-snap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
