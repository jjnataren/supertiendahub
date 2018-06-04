<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloSnap */

$this->title = 'Create Articulo Snap';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-snap-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
