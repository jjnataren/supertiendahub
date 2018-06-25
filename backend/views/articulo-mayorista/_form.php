<?php

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayorista */
/* @var $form yii\bootstrap\ActiveForm */


?>

<div class="articulo-mayorista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
    
    <?php echo $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <?php echo $form->field($model, 'precio')->textInput() ?>

    <?php echo $form->field($model, 'sku_fabricante')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'linea')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>

    



    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>






</div>