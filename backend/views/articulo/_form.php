<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Articulo */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'sku_fabricante')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'seccion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'linea')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'serie')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'peso')->textInput() ?>

    <?php echo $form->field($model, 'alto')->textInput() ?>

    <?php echo $form->field($model, 'largo')->textInput() ?>

    <?php echo $form->field($model, 'ancho')->textInput() ?>

    <?php echo $form->field($model, 'moneda')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'almacen')->textInput() ?>

    <?php echo $form->field($model, 'existencia')->textInput() ?>

    <?php echo $form->field($model, 'disponible')->textInput() ?>

    <?php echo $form->field($model, 'ultima_modificacion')->textInput() ?>

    <?php echo $form->field($model, 'id_usuario_modifico')->textInput() ?>

    <?php echo $form->field($model, 'id_snap')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>