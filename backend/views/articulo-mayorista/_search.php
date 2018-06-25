<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ArticuloMayoristaSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="articulo-mayorista-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'sku') ?>

    <?php echo $form->field($model, 'sku_fabricante') ?>

    <?php echo $form->field($model, 'seccion') ?>

    <?php echo $form->field($model, 'linea') ?>

    <?php // echo $form->field($model, 'marca') ?>

    <?php // echo $form->field($model, 'serie') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'alto') ?>

    <?php // echo $form->field($model, 'largo') ?>

    <?php // echo $form->field($model, 'ancho') ?>

    <?php // echo $form->field($model, 'moneda') ?>

    <?php // echo $form->field($model, 'almacen') ?>

    <?php // echo $form->field($model, 'existencia') ?>

    <?php // echo $form->field($model, 'disponible') ?>

    <?php // echo $form->field($model, 'ultima_modificacion') ?>

    <?php // echo $form->field($model, 'id_usuario_modifico') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
