<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\ArticuloPrestashopSnapSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-prestashop-snap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'fecha_creacion') ?>

    <?php echo $form->field($model, 'nombre') ?>

    <?php echo $form->field($model, 'descripcion') ?>

    <?php echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'disponible') ?>

    <?php // echo $form->field($model, 'actual') ?>

    <?php // echo $form->field($model, 'numero_registros') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
