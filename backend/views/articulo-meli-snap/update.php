<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeliSnap */

$this->title = 'Actualizar Articulo Mercado Libre Snap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mercado Libre Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="articulo-meli-snap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
