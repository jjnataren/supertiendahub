<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashop */

$this->title = 'Create Articulo Prestashop';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Prestashops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-prestashop-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
