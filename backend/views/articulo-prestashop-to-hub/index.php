<?php

use backend\assets\SwalAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $result array */

$this->title = 'Articulo Prestashop';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';

SwalAsset::register($this);

$this->registerJsFile('@web/js/prestashop.to.hub.js', ['depends' => [\backend\assets\BackendAsset::class]]);

?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Cambios que se pueden actualizar en
                    HUB <?php echo date('d/M/Y H:i:s ') ?></h3>
                <div class="box-tools pull-right">
                    <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse"
                            class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <?php
                echo Html::beginTag('table', ['id' => 'ps_to_hub_table', 'class' => 'table table-striped table-bordered',
                    'style' => 'width:100%']);

                echo Html::beginTag('thead');
                echo Html::beginTag('tr');
                echo Html::tag('th', 'Id PrestaShop');
                echo Html::tag('th', 'Sku');
                echo Html::tag('th', 'Descripción');
                echo Html::tag('th', 'Cantidad Prestashop');
                echo Html::tag('th', 'Cantidad HUB');
                echo Html::tag('th', 'Importar a HUB');
                echo Html::endTag('tr');
                echo Html::endTag('thead');

                echo Html::beginTag('tbody');
                foreach ($result as $r) {
                    echo Html::beginTag('tr');
                    echo Html::tag('td', $r['id_prestashop']);
                    echo Html::tag('td', $r['reference']);
                    echo Html::tag('td', $r['description']);
                    echo Html::tag('td', $r['quantity']);
                    echo Html::tag('td', $r['quantity_hub']);
                    echo Html::beginTag('td');
                    echo Html::tag('button', 'Importar Cantidad', ['class' => 'btn btn-primary import',
                        'data-sku' => \yii\helpers\Json::encode($r)]);
                    echo Html::endTag('td');
                    echo Html::endTag('tr');
                }
                echo Html::endTag('tbody');

                echo Html::endTag('table');
                ?>

            </div>
        </div>
    </div>
</div>