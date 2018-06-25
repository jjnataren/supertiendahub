<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashop */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-prestashop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'id_prestashop')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
