<?php

use yii\grid\SerialColumn;
use backend\assets\StepsAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ArticuloMeliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $paridad float */

$this->title = 'Articulo Mercado Libre';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';

StepsAsset::register($this);

$this->registerJsFile('@web/js/meli.js', ['depends' => [\yii\web\JqueryAsset::class]]);

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
                        <dd>Mercado Libre</dd>

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

                        <dt><i class="fa fa-dollar"></i> Precio D&oacute;lar</dt>
                        <dd>$
                            <?php
                            echo $paridad
                            ?>
                            MXN
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Precios actuales en
                    Mercado Libre <?php echo date('d/M/Y H:i:s ') ?></h3>
            </div>
            <div class="box-body">
                <?php Pjax::begin(['id' => 'meli_articles']) ?>
                <?php
                try {
                    echo \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => SerialColumn::class],
                            'sku',
                            'id',
                            'marca',
                            'serie',
                            'precio',
                            'precio_original',
                        ]
                    ]);
                } catch (Exception $e) {
                    echo 'Ocurri&oacute; un error al cargar los articulos.';
                }
                ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Precios que se pueden actualizar en
                    Mercado Libre <?php echo date('d/M/Y H:i:s ') ?></h3>
            </div>
            <div class="box-body" id="wizard">

                <h1>Buscar actualizaciones</h1>
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <p>1.- Presione el bot&oacute;n <b>Buscar</b> para buscar los cambios.</p>
                                <p>2.- Cuando el listado de posibles cambios aparezca, empieze a seleccionar los cambios
                                    que
                                    se ejecutar&aacute;n</p>
                                <p>3.- Cuando termine de realizar la selecci&oacute;n presione el bot&oacute;n <b>Siguiente</b>.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="meli_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>ID en Mercado Libre</th>
                                        <th>Marca</th>
                                        <th>Serie</th>
                                        <th>Precio</th>
                                        <th>Precio Original</th>
                                        <th>Cambio</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group" role="group">
                            <button class="btn btn-app" id="synchronize_button">
                                <i class="fa fa-search"></i>
                                Buscar
                            </button>

                            <button class="btn btn-app" id="synchronize_button_next">
                                <i class="fa fa-arrow-right"></i>
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>

                <h1>Validar cambios</h1>
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <p>1.- Cuando termine de validar los cambios presione el bot&oacute;n <b>Siguiente</b>.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="meli_table_selection" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Precio</th>
                                        <th>Precio Original</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group" role="group">
                            <button class="btn btn-app" id="validation_button_next">
                                <i class="fa fa-arrow-right"></i>
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>

                <h1>Generar Snapshot</h1>
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <p>1.- Presione el bot&oacute;n <b>Generar</b> para guardar el estado actual de los
                                    productos.</p>
                                <p>2.- Cuando est&eacute; listo presione el bot&oacute;n <b>Siguiente</b>.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username" id="snap_name"></h3>
                                        <h5 class="widget-user-desc" id="snap_desc"></h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                                <span id="snap_records">N&uacute;mero de registros</span>
                                                <span class="pull-right badge bg-aqua-active"
                                                      id="snap_records_value"></span>
                                            </li>
                                            <li>
                                                <span id="snap_fecha">Fecha</span>
                                                <span class="pull-right" id="snap_records_date"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group" role="group">
                            <button class="btn btn-app" id="snapshot_button">
                                <i class="fa fa-camera"></i>
                                Generar
                            </button>

                            <button class="btn btn-app" id="snapshot_button_next">
                                <i class="fa fa-arrow-right"></i>
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>

                <h1>Actualizar</h1>
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <p>1.- Cuando est&eacute; listo presione el bot&oacute;n <b>Actualizar</b>.</p>
                                <p>2.- Cuando el proceso termine se mostrar&aacute; una tabla con los cambios
                                    realizados.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="meli_table_updated" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>ID en Mercado Libre</th>
                                        <th>Marca</th>
                                        <th>Serie</th>
                                        <th>Precio</th>
                                        <th>Precio Original</th>
                                        <th>Cambio</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group" role="group">
                            <button class="btn btn-app" id="update_button">
                                <i class="fa fa-refresh"></i>
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>