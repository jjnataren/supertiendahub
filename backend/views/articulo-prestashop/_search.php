<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\ArticuloPrestashopSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-prestashop-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'sku') ?>

    <?php echo $form->field($model, 'id_prestashop') ?>

    <?php echo $form->field($model, 'marca') ?>

    <?php echo $form->field($model, 'serie') ?>

    <?php echo $form->field($model, 'precio') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
