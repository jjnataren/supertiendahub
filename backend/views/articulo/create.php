<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Articulo */

$this->title = 'Create Articulo';
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
