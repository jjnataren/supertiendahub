<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeliSnap */

$this->title = 'Update Articulo Meli Snap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Meli Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-meli-snap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
