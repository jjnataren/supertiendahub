<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ArticuloPrestashopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Prestashops';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';

$this->registerJsFile('@web/js/prestashop.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Proveedor</h3>
            </div>
            <div class="box-body">
                <div class="col-md-3">
                    <dl>
                        <dt>Nombre del proveedor</dt>
                        <dd>Prestashop</dd>

                        <dt>Direcci&oacute;n</dt>
                        <dd>Ciudad de M&eacute;xico</dd>

                        <dt><i class="fa fa-black-tie"></i> Responsable</dt>
                        <dd>Jhon doe</dd>

                        <dt><i class="fa fa-phone"></i> Tel&eacute;fono de contacto</dt>
                        <dd>+5255 51078305</dd>
                    </dl>
                </div>
                <div class="col-md-3">
                    <dl>
                        <dt>Ultima actualización</dt>
                        <dd><?= date('d/m/Y') ?></dd>

                        <dt>Estatus</dt>
                        <dd>
                            <div id="globalStatus">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="box-footer">
                <?php
                    echo Html::button('Sincronizar', ['id' => 'synchronize_button', 'class' => 'btn btn-primary']);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Precios guardados en SUPERTIENDA HUB <?php echo date('d/M/Y H:i:s ')?></h3>
            </div>
            <div class="box-body">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

    </div>
</div>