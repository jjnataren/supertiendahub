<?php

/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 21/06/2018
 * Time: 11:47 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model common\models\KeyStorageItem */
?>

<div class="articulo-prestashop-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'comment')->textInput(['readonly'=>'readonly']) ?>

    <?php echo $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
