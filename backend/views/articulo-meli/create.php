<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeli */

$this->title = 'Create Articulo Meli';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Melis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-meli-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
