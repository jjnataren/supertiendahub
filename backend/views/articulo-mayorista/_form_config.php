<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="row">

<div class="col-md-12 col-xs-12 col-sm-12">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'comment')->textInput(['readonly'=>'readonly'])->label('Configuración') ?>

    <?php echo $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>