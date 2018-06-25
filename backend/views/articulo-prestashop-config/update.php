<?php

/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 21/06/2018
 * Time: 11:46 AM
 */

/* @var $model common\models\KeyStorageItem */

$this->title = 'Actualizar Configuraci&oacute;n Prestashop: ' . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Configuraci&oacute;n Prestashop', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="articulo-prestashop-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
