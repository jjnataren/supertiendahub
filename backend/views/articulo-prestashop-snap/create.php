<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashopSnap */

$this->title = 'Create Articulo Prestashop Snap';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Prestashop Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-prestashop-snap-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
