<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */

$this->title = 'Actualizar PHC Configuración, ' .$model->comment;
$this->params['breadcrumbs'][] = 'Modificar '.$model->comment;
?>
<div class="key-storage-item-update">

    <?php echo $this->render('_form_config', [
        'model' => $model,
    ]) ?>

</div>
