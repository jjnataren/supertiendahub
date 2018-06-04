<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloSnap */

$this->title = 'Update Articulo Snap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-snap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
