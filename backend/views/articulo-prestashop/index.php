<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ArticuloPrestashopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulo Prestashops';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';

$this->registerJsFile('@web/js/prestashop.js', ['depends' => [\yii\web\JqueryAsset::class]]);

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
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <?php
                        echo Html::button('Sincronizar', ['id' => 'synchronize_button', 'class' => 'btn btn-primary']);
                        ?>
                    </div>
                    <div class="btn-group" role="group">
                        <?php
                        echo Html::button('Generar Snapshot', ['id' => 'snapshot_button', 'class' => 'btn btn-info']);
                        ?>
                    </div>
                    <div class="btn-group" role="group">
                        <?php
                        echo Html::button('Actualizar', ['id' => 'update_button', 'class' => 'btn btn-warning', 'disabled' => 'disabled']);
                        ?>
                    </div>
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
                <h3 class="box-title">Precios que se pueden actualizar en Prestashop <?php echo date('d/M/Y H:i:s ')?></h3>
            </div>
            <div class="box-body">
                <table id="prestashop_table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>sku</th>
                            <th>id_prestashop</th>
                            <th>marca</th>
                            <th>serie</th>
                            <th>precio</th>
                            <th>cambio</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Precios actuales en el sistema ADATA de Prestashop <?php echo date('d/M/Y H:i:s ')?></h3>
            </div>
            <div class="box-body">
                <?php try
                {
                    echo \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'sku',
                            'id_prestashop',
                            'marca',
                            'serie',
                            'precio',
                        ]
                    ]);
                } catch (Exception $e) {
                    echo 'Ocurri&oacute; un error al cargar productos';
                }
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
                <h3 class="box-title">Snapshots en el sistema ADATA de Prestashop <?php echo date('d/M/Y H:i:s ')?></h3>
            </div>
            <div class="box-body">
                <?php try
                {
                    echo \yii\grid\GridView::widget([
                        'dataProvider' => $dataProviderSnap,
                        'filterModel' => $searchModelSnap,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'fecha_creacion',
                            'nombre',
                            'disponible',
                            'actual',
                            'numero_registros',
                        ]
                    ]);
                } catch (Exception $e) {
                    echo 'Ocurri&oacute; un error al cargar productos: ';
                }
                ?>
            </div>
        </div>
    </div>
</div>