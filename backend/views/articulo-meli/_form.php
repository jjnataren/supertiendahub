<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeli */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-meli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'id_meli')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'precio')->textInput() ?>

    <?php echo $form->field($model, 'cambio')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
