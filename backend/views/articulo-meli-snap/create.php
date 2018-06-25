<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeliSnap */

$this->title = 'Create Articulo Meli Snap';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Meli Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-meli-snap-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
