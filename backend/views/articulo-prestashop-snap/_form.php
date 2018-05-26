<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloPrestashopSnap */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-prestashop-snap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'fecha_creacion')->textInput() ?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'disponible')->textInput() ?>

    <?php echo $form->field($model, 'actual')->textInput() ?>

    <?php echo $form->field($model, 'numero_registros')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>