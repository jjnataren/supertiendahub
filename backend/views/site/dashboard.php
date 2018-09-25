<?php

use backend\assets\SwalAsset;
use kartik\grid\GridView;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\web\View;
use backend\models\util\Util;
use backend\models\constants\Constantes;


$this->title = '  SUPER TIENDA HUB';

$this->registerJs("$('#help1').popover('hide');", View::POS_END, 'my-options1');
$this->registerJs("$('#help2').popover('hide');", View::POS_END, 'my-options2');

Yii::$app->formatter->locale = 'es-MX';

$this->params['subtitle'] = '';

$this->params['titleIcon'] = '<i class="fa fa-mixcloud fa-2x"></i>';

SwalAsset::register($this);

$this->registerJsFile('@web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::class]]);


?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <i class="fa fa-money"></i>
                    <label id="label_paridad"></label>
                    <label id="label_paridad_estatus"></label>
               		<i id="paridad" class="fa fa-spinner fa-spin"></i>
                </h3>
                <p>

                    Paridad dolar PCH mayoristas
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="#anchor_dash" id="request_paridad">
                Revisar <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h3>
                   <i class="fa fa-cart-arrow-down"></i>
                                       <label id="label_phc"></label>
                                       <label id="label_phc_estatus"></label>
                                       <i id="phc_icon" class="fa fa-spinner fa-spin"></i>
                </h3>
                <p>
                    Cambios en PCH

                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer" href="#anchor_supertienda">
                Ir <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    <i class="fa  fa-truck"></i>
                    5
                </h3>
                <p>
                    Cambios en Mercado Libre
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer" href="#anchor_constancia1">
                Ir <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><i class="fa fa-sellsy"></i> 7 </h3>
                <p>Cambios en PrestaShop</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer" href="#anchor_constancia1">
                Ir <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->
<h4 class="page-header" id="anchor_supertienda">
    Articulos de SUPER TIENDA
    <small>almacenados en base de datos.</small>
</h4>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">

             <li>
             	<a data-toggle="tab" href="#tab_sync">
             		<small id="bag_count_phc" class="label label-danger"><i class="fa fa-spinner fa-spin"></i></small> SUPER TIENDA - PCH
             	</a>
             </li>
             <li class="active"><a data-toggle="tab" href="#tab_super_tienda"><i class="fa fa-database"></i> SUPER TIENDA</a></li>


                <li class="pull-left header"><i class="fa fa-mixcloud"></i> SUPER TIENDA HUB</li>
            </ul>
            <div class="tab-content">

                <div id="tab_super_tienda" class="tab-pane active">


                     			<table id="dashboard_table"
                                           class="table table-bordered table-hover table-condensed">
                                        <thead>
                                         <tr>
                                         	<th colspan="4" rowspan="2" style="text-align: center; vertical-align: middle;">
                                         		<i class="fa fa-mixcloud"></i> Super Tienda
                                         	</th>
                                         	<th colspan="2" style="text-align: center;" class="bg-light-blue">
                                         		<i class="fa fa-cart-arrow-down"></i> PCH
                                         	</th>
											<th colspan="4" class="bg-purple" style="text-align: center;" >
												<i class="fa fa-sellsy"></i> Prestashop
											</th>
											<th colspan="4" style="text-align: center;" class="bg-yellow">
												<i class="fa fa-truck"></i> Me Libre
											</th>
                                         </tr>
                                          <tr>
                                         	<th style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;" >
                                         		<i class="fa fa-usd"></i>
                                         	</th>
                                         	<th style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;" >
                                         		<i class="fa fa-cubes"></i>
                                         	</th>

											<th  colspan="2" style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
												<i class="fa fa-usd"></i>
											</th>
											<th colspan="2" style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
												<i class="fa fa-cubes"></i>
											</th>

											<th colspan="2" style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
												<i class="fa fa-usd"> </i>
											</th>
											<th colspan="2" style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
												<i class="fa fa-cubes"></i>
											</th>
                                         </tr>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Descripción</th>
                                            <th><i class="fa fa-usd"></i></th>
                                            <th><i class="fa fa-cubes"></i></th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
                                            	<small><i class="fa  fa-database"></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
                                            	<small><i class="fa  fa-database"></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
                                            	<small><i class="fa  fa-database"></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
                                            	<small><i class="fa  fa-database"></i></small>
                                            </th>
                                            <th style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
                                            	<small><i class="fa   fa-internet-explorer "></i></small>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach($hubItems as $hubItem ): ?>
                                        <?php $hubitemPrecio = ($hubItem->moneda == 'USD') ? $hubItem->precio * $dollar: $hubItem->precio ;

                                            $pchItemExist =    isset( $pchItems[$hubItem->sku]);


                                            $pchStyle =    ($pchItemExist && $hubItem->precio*1 !==  $pchItems[$hubItem->sku]->precio*1) ? "warning" : "";

                                            $pchStyle = $pchItemExist ? $pchStyle :"danger";

                                            $pricePSHub = round(Util::getPSFinalprice($hubItem->precio, $hubItem->utilidad_ps, $dollar, ($hubItem->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$hubItem->tipo_utilidad_ps),2);

                                            $pricePSHub = $pricePSHub === null ? '--' : $pricePSHub;

                                            $pricePSOnline = isset($psItems[$hubItem->sku])?round($psItems[$hubItem->sku]['price'],2):'--';

                                            $pricePSNotSync = $pricePSOnline !== $pricePSHub;

                                            $quantityPSHub =  $hubItem->existencia_ps?$hubItem->existencia_ps:'--';

                                            $quantityPSOnline = isset($psItems[$hubItem->sku])?$psItems[$hubItem->sku]['quantity']:'--';

                                            $quantityPSNotSync = $quantityPSHub !== $quantityPSOnline;

                                        ?>
                                        	<tr>
                                        		<td><?=$hubItem->sku; ?></td>
                                        		<td><?=$hubItem->descripcion; ?></td>
                                        		<td><?=($hubItem->moneda == 'USD') ? $hubitemPrecio .  ' MN <br /><i>( ' .$hubItem->precio . ' ' .  $hubItem->moneda . ')</i>' : $hubItem->precio. ' ' .$hubItem->moneda; ?></td>
                                        		<td><?=$hubItem->existencia; ?></td>
                                        		<td class="<?= $pchStyle ?>" style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;">
                                        			<?= isset($pchItems[$hubItem->sku]->precio)?$pchItems[$hubItem->sku]->precio. ' ' .$pchItems[$hubItem->sku]->moneda:'--' ?>
                                        		</td>
												<td  class="<?= $pchStyle ?>" style="align-content: center; text-align: center; border-bottom-color: #3c8dbc; border-left-color: #3c8dbc; border-right-color: #3c8dbc; border-top-color: #3c8dbc;">
													<?= isset($pchItems[$hubItem->sku]->existencia)?$pchItems[$hubItem->sku]->existencia:'--' ?>
												</td>
												<td <?=$pricePSNotSync ? "class='warning'":""; ?> style="border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
													<?= $pricePSHub; ?>
												</td>
                                        		<td <?=$pricePSNotSync ? "class='warning'":""; ?> style="border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
                                        			<?= $pricePSOnline; ?>
                                        		</td>
												<td <?=$quantityPSNotSync ? "class='warning'":""; ?> style="border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
													<?=$hubItem->existencia_ps?$hubItem->existencia_ps:'--'; ?>
												</td>
												<td <?=$quantityPSNotSync ? "class='warning'":""; ?> style="border-bottom-color: #605ca8; border-left-color: #605ca8; border-right-color: #605ca8; border-top-color: #605ca8;">
													<?= isset($psItems[$hubItem->sku])?$psItems[$hubItem->sku]['quantity']:'--'; ?>
												</td>
												<td style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
													<?= round(Util::getMLFinalprice($hubItem->precio, $hubItem->utilidad_ml, $dollar, ($hubItem->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  , $hubItem->tipo_utilidad_ml, $hubItem->comision_ml),2); ?>
												</td>
												<td style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
													<?=0; ?>
												</td>
												<td style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
													<?=$hubItem->existencia_ml; ?>
												</td>
												<td style="align-content: center; text-align: center; border-bottom-color: #f39c12; border-left-color: #f39c12; border-right-color: #f39c12; border-top-color: #f39c12;">
													<?=0; ?>
												</td>

                                        	</tr>

										<?php endforeach;?>
                                        </tbody>
                                    </table>


                    <p class="text-right">
                        <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda"
                                data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
                        </button>
                        <?= Html::a('<i class="fa fa-mixcloud"></i> Administrar hub', ['articulo/index',], ['class' => 'btn btn-default btn-flat btn-sm']) ?>
                    	<?= Html::a('<i class="fa fa-sellsy"></i> Administrar PrestaShop', ['articulo-prestashop-to-hub/index',], ['class' => 'btn btn-flat btn-sm bg-purple']) ?>

                    </p>
                </div><!-- /.tab-pane -->

                <div id="tab_sync" class="tab-pane">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="phcMayoristaSync">

                                        <img src="/img/loading.gif"/>
                                        <p class="text text-info">Consultando servicio PCH Mayorista ....</p>

                                    </div>
                                </div>
                                <div class="panel-footer">

                                    <a href="/articulo-mayorista/index" class="btn btn-primary"
                                       id="syncrequest">Actualizar </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div>


</div>


<h4 class="page-header" id="anchor_ml">

    <i class="fa fa-truck"></i> Mercado Libre
    <small>Almacen de datos, online y comparador.</small>


</h4>

<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right" id="tabs_mercadolibre">

                <li><a data-toggle="tab" href="#tab_ml_sync_comp_hub">ML HUB - ML Online</a></li>

                <li><a data-toggle="tab" href="#tab_ml_sync_comp"><i class="fa fa-exchange"></i> MercadoLibre HUB -
                        SuperTienda HUB</a></li>
                <li><a data-toggle="tab" href="#tab_ml_request"><i class="fa fa-cloud"></i> MercadoLibre Online</a></li>

                <li class="active"><a data-toggle="tab" href="#tab_mercado_libre"><i class="fa fa-database"> </i>
                        MercadoLibre HUB</a></li>
                <li class="pull-left header"><i class="fa fa-truck"></i> MercadoLibre HUB</li>
            </ul>
            <div class="tab-content">

                <div id="tab_mercado_libre" class="tab-pane active">


                    <?php try {
                        echo GridView::widget([
                            'dataProvider' => $dataProviderML,
                            'filterModel' => $searchModelML,


                            'columns' => [

                                'sku',
                                'id',
                                [
                                    'attribute' => 'precio',
                                    'content' => function ($data) {
                                        return Yii::$app->formatter->asCurrency($data->precio);
                                    }
                                ],

                                'marca',


                                ['class' => 'yii\grid\ActionColumn',
                                    'options' => ['class' => 'skip-export']
                                ],

                            ],
                            'toolbar' => [
                                ['content' =>
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-default', 'title' => 'Reiniciar grid'])
                                ],
                                '{export}',
                                '{toggleData}'
                            ],


                            'beforeHeader' => [
                                [
                                    'columns' => [
                                        ['content' => 'Precios de la ultima imagen tomada', 'options' => ['colspan' => 3, 'class' => 'text text-left']],
                                        ['content' => Yii::$app->formatter->asDate(date('Y-m-d')), 'options' => ['colspan' => 2, 'class' => 'text-center']],
                                    ],
                                    //  'options'=>['class'=>'skip-export'] // remove this row from export
                                ]
                            ],


                            'pjax' => true,
                            'bordered' => true,
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'hover' => true,
                            'floatHeader' => true,
                            'floatHeaderOptions' => ['scrollingTop' => true],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY
                            ],
                        ]);
                    } catch (Exception $e) {
                        echo 'No se pudo cargar la tabla.';
                    } ?>


                    <p class="text-right">
                        <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda"
                                data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
                        </button>
                        <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['#'], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                    </p>
                </div><!-- /.tab-pane -->

                <div id="tab_ml_request" class="tab-pane">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="ml_sync">

                                        <img src="/img/loading.gif"/>
                                        <p class="text text-info">Consultando Mercado libre ....</p>

                                    </div>
                                </div>
                                <div class="panel-footer">

                                    <a href="#anchor_ml" class="btn btn-primary" id="ml_syncrequest"><i
                                                class="fa fa-refresh"></i>Actualizar </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="tab_ml_sync_comp" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <table id="meli_hub_table"
                                           class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Descripci&oacute;n</th>
                                            <th>Precio HUB</th>
                                            <th>Precio Mercado Libre HUB</th>
                                            <th>Precio Mercado Libre Ganancia HUB</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab_ml_sync_comp_hub" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <table id="meli_hub_online_table"
                                           style="width: 100%"
                                           class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Referencia</th>
                                            <th>Precio Mercado Libre</th>
                                            <th>Precio Mercado Libre HUB</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div>


</div>


<h4 class="page-header" id="anchor_ps">

    <i class="fa fa-sellsy"></i> PrestaShop
    <small>Almacen de datos, online y comparador.</small>


</h4>

<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right" id="tabs_prestashop">
                <?php $i = 1; ?>

                <li><a data-toggle="tab" href="#tab_sync_ps_pson">PrestaShop - PrestaShop Online</a></li>

                <li><a data-toggle="tab" href="#tab_ps_sync_comp"><i class="fa fa-exchange"></i> PrestaShop HUB -
                        SuperTienda HUB</a></li>
                <li><a data-toggle="tab" href="#tab_ps_request"><i class="fa fa-cloud"></i> PrestaShop Online</a></li>

                <li class="active"><a data-toggle="tab" href="#tab_ps_hub"><i class="fa fa-database"> </i> Prestashop
                        HUB</a></li>


                <li class="pull-left header"><i class="fa fa-sellsy"></i> PrestaShop HUB</li>
            </ul>
            <div class="tab-content">

                <div id="tab_ps_hub" class="tab-pane active">


                    <?php try {
                        echo GridView::widget([
                            'dataProvider' => $dataProviderPS,
                            'filterModel' => $searchModelPS,


                            'columns' => [

                                'sku',
                                'id_prestashop',
                                [
                                    'attribute' => 'precio',
                                    'content' => function ($data) {
                                        return Yii::$app->formatter->asCurrency($data->precio);
                                    }
                                ],

                                'marca',


                                ['class' => 'yii\grid\ActionColumn',
                                    'options' => ['class' => 'skip-export']
                                ],

                            ],
                            'toolbar' => [
                                ['content' =>
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-default', 'title' => 'Reiniciar grid'])
                                ],
                                '{export}',
                                '{toggleData}'
                            ],


                            'beforeHeader' => [
                                [
                                    'columns' => [
                                        ['content' => 'Precios de la ultima imagen tomada', 'options' => ['colspan' => 3, 'class' => 'text text-left']],
                                        ['content' => Yii::$app->formatter->asDate(date('Y-m-d')), 'options' => ['colspan' => 2, 'class' => 'text-center']],
                                    ],
                                    //  'options'=>['class'=>'skip-export'] // remove this row from export
                                ]
                            ],


                            'pjax' => true,
                            'bordered' => true,
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'hover' => true,
                            'floatHeader' => true,
                            'floatHeaderOptions' => ['scrollingTop' => true],
                            'panel' => [
                                'type' => GridView::TYPE_PRIMARY
                            ],
                        ]);
                    } catch (Exception $e) {
                        echo 'No se pudo cargar la tabla';
                    } ?>


                    <p class="text-right">
                        <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda"
                                data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
                        </button>
                        <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['#', 'id' => 1], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                    </p>
                </div><!-- /.tab-pane -->

                <div id="tab_ps_request" class="tab-pane">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="ps_sync">

                                        <img src="/img/loading.gif"/>
                                        <p class="text text-info">Consultando servicio ....</p>

                                    </div>
                                </div>
                                <div class="panel-footer">

                                    <a href="#anchor_ps" class="btn btn-primary" id="ps_syncrequest">Actualizar </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="tab_ps_sync_comp" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <table id="prestashop_hub_table"
                                           class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Descripci&oacute;n</th>
                                            <th>Precio HUB</th>
                                            <th>Precio Prestashop HUB</th>
                                            <th>Precio Prestashop Ganancia HUB</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab_sync_ps_pson" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <table id="prestashop_hub_online_table"
                                           class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Referencia</th>
                                            <th>Precio</th>
                                            <th>Precio Prestashop HUB</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div>


</div>


<h4 class="page-header">
    <i class="fa fa-info-circle"></i> Soporte y Ayuda
    <small>Contenido de ayuda</small>
</h4>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Super tienda HUB</h3>
                <div class="box-tools pull-right">
                    <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse"
                            class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs"
                            data-original-title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div id="accordion" class="box-group">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">
                                <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">

                                    <b>PHC Mayoristas</b>

                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse in" id="collapseOne">
                            <div class="box-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-info">
                        <div class="box-header">
                            <h4 class="box-title">
                                <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse">
                                    <b> Mercado Libre</b>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo">
                            <div class="box-body">


                            </div>
                        </div>
                    </div>

                    <div class="panel box box-info">
                        <div class="box-header">
                            <h4 class="box-title">
                                <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse">
                                    <b> Sincronizar PrestaShop</b>
                                </a>

                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree">
                            <div class="box-body">


                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-envelope"></i>
                <h1 class="box-title">Contacto y soporte técnico</h1>
                <div class="box-tools pull-right">
                    <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse"
                            class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs"
                            data-original-title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">


                <address>
                    <strong> <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '') ?></strong><br>
                    <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.direccion', '') ?><br>
                    <abbr title="Telefono de contacto">Tel:</abbr> <?= Yii::$app->keyStorage->get('com.pinfo.contacto.telefono', '0155 5551078307') ?>
                </address>

                <address>
                    <strong>Correo electronico</strong><br>
                    <a href="mailto:#">  <?= Yii::$app->keyStorage->get('com.pinfo.contacto.email', 'admin.pinfo@pinfosoft.com.mx') ?></a>
                    <br/>


                </address>
                <h4>
                    <i class="fa fa-twitter"></i>
                    <a href="<?= Yii::$app->keyStorage->get('com.pinfo.contacto.tw', '') ?>"
                       target="blank"><?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '@pizo') ?></a>
                </h4>
            </div>
        </div>
    </div>
</div>


<?php JSRegister::begin(); ?>
<script>


    $('#syncrequest').click(function () {

        doAjaxPHC("/articulo/sync-phc-resume?dashboard=true");

    });

    $('#ml_syncrequest').click(function () {

        doAjaxML("/articulo-meli/get-items-view");

    });

    $('#ps_syncrequest').click(function () {

        doAjaxPS("/articulo-prestashop/get-items-view");

    });


    $('#request_paridad').click(function () {


        $('#label_paridad').html('--');
        doAjaxGetParidad("/articulo-mayorista/get-paridad");

    });


    function doAjaxGetParidad(filterUrl) {

        $('#ps_sync').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio en linea ....</p>");

        $.ajax({
            type: "GET",
            url: filterUrl,
            data: {}, success: function (result) {
				$('#paridad').attr('class', '');
                 $('#label_paridad').html("$"+Math.round(result * 100) / 100);

            }, error: function (result) {

                $('#label_paridad_estatus').html('Error ');

            }
        });
    }


    function doAjaxPS(filterUrl) {

        $('#ps_sync').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio en linea ....</p>");

        $.ajax({
            type: "GET",
            url: filterUrl,
            data: {}, success: function (result) {


                $('#ps_sync').html(result);

                $('#ps_data_grid').DataTable({
                    'scrollX': false,
                    'language': {
                        'lengthMenu': 'Display _MENU_ records per page',
                        'zeroRecords': 'Nothing found - sorry',
                        'info': 'Showing page _PAGE_ of _PAGES_',
                        'infoEmpty': 'No records available',
                        'infoFiltered': '(filtered from _MAX_ total records)'
                    }
                });


            }, error: function (result) {

                $('#ps_sync').html('Ha ocurrido un error intente mas tarde ...' + result);

            }
        });
    }


    function doAjaxML(filterUrl) {

        $('#ml_sync').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio Mercado Libre ....</p>");

        $.ajax({
            type: "GET",
            url: filterUrl,
            data: {}, success: function (result) {


                $('#ml_sync').html(result);

                $('#ml_data_grid').DataTable({
                    'scrollX': false,
                    'language': {
                        'lengthMenu': 'Display _MENU_ records per page',
                        'zeroRecords': 'Nothing found - sorry',
                        'info': 'Showing page _PAGE_ of _PAGES_',
                        'infoEmpty': 'No records available',
                        'infoFiltered': '(filtered from _MAX_ total records)'
                    }
                });


            }, error: function (result) {

                $('#ml_sync').html('Ha ocurrido un error intente mas tarde ...' + result);

            }
        });
    }


    function doAjaxPHC(filterUrl) {

        $('#phcMayoristaSync').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>");

        $.ajax({
            type: "GET",
            url: filterUrl,
            data: {}, success: function (result) {


                $('#phcMayoristaSync').html(result);

                 $('#label_phc').html( $('#totalChanges').val());

             	$('#bag_count_phc').html( $('#totalChanges').val())


             $('#phc_icon').attr('class', '');

                $('#comparegrid').DataTable({});


                $('#sync_success').click(function () {


                    doAjaxPHC("/articulo/sync-phc-resume?filter=success&dashboard=true");

                });

                $('#sync_info').click(function () {


                    doAjaxPHC("/articulo/sync-phc-resume?filter=info&dashboard=true");

                });


                $('#sync_warning').click(function () {

                    doAjaxPHC("/articulo/sync-phc-resume?filter=warning&dashboard=true");


                });


                $('#sync_all').click(function () {

                    doAjaxPHC("/articulo/sync-phc-resume?dashboard=true");


                });


            }, error: function (result) {

             $('#label_phc_estatus').html('Error');
            }
        });
    }

    $(document).ready(function () {


        $('#syncrequest').trigger('click');
        $('#ml_syncrequest').trigger('click');
        $('#ps_syncrequest').trigger('click');
        $('#request_paridad').trigger('click');


        $('#dashboard_table').DataTable({
            'scrollX': true,
            'language': {
                'lengthMenu': 'Display _MENU_ records per page',
                'zeroRecords': 'Nothing found - sorry',
                'info': 'Mostrando pagina _PAGE_ de _PAGES_',
                'infoEmpty': 'No records available',
                'infoFiltered': '(filtered from _MAX_ total records)'
            }
        });


    });


</script>
<?php JSRegister::end(); ?>