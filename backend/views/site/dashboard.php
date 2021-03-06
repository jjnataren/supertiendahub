<?php

use backend\assets\SwalAsset;
use common\models\KeyStorageItem;
use richardfan\widget\JSRegister;
use yii\web\View;


$this->title = '  SUPER TIENDA HUB';

$this->registerJs("$('#help1').popover('hide');", View::POS_END, 'my-options1');
$this->registerJs("$('#help2').popover('hide');", View::POS_END, 'my-options2');

Yii::$app->formatter->locale = 'es-MX';

$this->params['subtitle'] = '';

$this->params['titleIcon'] = '<i class="fa fa-mixcloud fa-2x"></i>';

SwalAsset::register($this);

$this->registerJsFile('@web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::class]]);


$this->registerJs('
    setInterval(function(){

     $("#reset_st_dashboard").trigger("click");
    }, 120000);', \yii\web\VIEW::POS_HEAD);


?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <i class="fa fa-money"></i>
                    <label id="label_paridad"><?=$dollar?></label>
                    <label id="label_paridad_estatus"></label>
               		<i id="paridad" class=""></i>
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
                                       <label id="label_phc"><?= count($pchItemsAll) ?></label>
                                       <label id="label_phc_estatus"></label>
                </h3>
                <p>
                    Nuevos Productos en PCH
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
                <h3><i class="fa fa-sellsy"></i><?= count($psItems) ?></h3>
                <p>Articulos en PrestaShop</p>
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
             	<a data-toggle="tab" href="#tab_new"><i class="fa fa-cart-arrow-down"></i> PCH Importar</a>

             </li>
             <li class="active">
             	<a data-toggle="tab" href="#tab_super_tienda"><i class="fa fa-database"></i> SUPER TIENDA</a>

             </li>



                <li class="pull-left header"><i class="fa fa-mixcloud"></i> SUPER TIENDA HUB</li>
            </ul>
            <div class="tab-content">

                <div id="tab_super_tienda" class="tab-pane active">

					<?php echo $this->render('_dashboard',
                    ['dollar'=>$dollar,
                    'pchItems'=>$pchItems,
                    'psItems'=>$psItems,
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider,

                    ]);?>

                    <p class="text-left">
                        <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover-ayuda" title="Ayuda"
                                data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
                        </button>




                    </p>
                </div><!-- /.tab-pane -->


				 <div id="tab_new" class="tab-pane">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="newItem">

									<table id="new_pch_items" class="display table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                               <th>sku</th>
                								<th>Descripción</th>
                								<th><i class="fa fa-dollar"></i> Precio</th>
                								<th>Moneda</th>
                								<th><i class="fa fa-cubes"></i> Existencia</th>
                								<th />
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>sku</th>
                								<th>Descripción</th>
                								<th><i class="fa fa-dollar"></i> Precio</th>
                								<th>Moneda</th>
                								<th><i class="fa fa-cubes"></i> Existencia</th>
                                            	<th />
                                            </tr>
                                        </tfoot>

                                    </table>

                                    </div>
                                </div>

								<div class="panel-footer">
							     	<a class="btn btn-primary" id="get_pch_items"><i class="fa fa-refresh"></i> Actualizar </a>
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
    <small>Tienda online</small>


</h4>

<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right" id="tabs_prestashop">
                <?php $i = 1; ?>


                <li><a data-toggle="tab" href="#tab_ps_request"><i class="fa fa-cloud"></i> PrestaShop Online</a></li>


                <li class="pull-left header"><i class="fa fa-sellsy"></i> PrestaShop Hub</li>
            </ul>
            <div class="tab-content">


                <div id="tab_ps_request" class="tab-pane active">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="ps_sync">

											<table class="table table-bordered table-responsive" style="width: 100%" id="ps_data_grid" >
                            					<thead>
                            						<tr>
                                						<th colspan="5">#Total Articulos <?=count($psItems)?></th>
                            						</tr>
                            						<tr>

                            							<th>id</th>
                            							<th>reference</th>
                            							<th>name</th>
                            							<th>price</th>
                            							<th>quantity</th>
														<th></th>
                            						</tr>
                            					</thead>
                            					<tbody>
                            						<?php

                            						$apiUrl = Yii::$app->getSecurity()->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));

                            						foreach($psItems as $articulo): ?>
                            						<tr>
                            						    <?php //TODO: take advantage of yii2 array helper?>
                            							<td><?=isset($articulo['id'])?$articulo['id']:''?></td>
                            							<td><?=(isset($articulo['reference']) && !is_array($articulo['reference']) ) ?$articulo['reference']:''?></td>
                            							<td><?=isset($articulo['name']['language'][0])?$articulo['name']['language'][0]:''?></td>
                            							<td><?=isset($articulo['price'])?$articulo['price']:''?></td>
                            							<td><?=isset($articulo['quantity'])?$articulo['quantity']:''?></td>
														<td><a href="<?=$apiUrl?>/index.php?id_product=<?=isset($articulo['id'])?$articulo['id']:''?>&controller=product" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-plane"></i> Consultar</a></td>
                            						</tr>
                            					<?php endforeach;?>
                            					</tbody>
                            				</table>


                                    </div>
                                </div>
                                <div class="panel-footer">

                                    <a class="btn btn-primary" id="ps_syncrequest"><i class="fa fa-refresh"></i> Actualizar </a>
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




<h4 class="page-header" id="anchor_ml">

    <i class="fa fa-truck"></i> Mercado Libre
    <small>Almacen de datos, online y comparador.</small>


</h4>

<div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right" id="tabs_mercadolibre">

                <li><a data-toggle="tab" href="#tab_ml_request"><i class="fa fa-cloud"></i> MercadoLibre Online</a></li>

                <li class="pull-left header"><i class="fa fa-truck"></i> MercadoLibre HUB</li>
            </ul>
            <div class="tab-content">


                <div id="tab_ml_request" class="tab-pane active">

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

                                    <a  class="btn btn-primary" id="ml_syncrequest"><i
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
                    <a href="mailto:#">  <?= Yii::$app->keyStorage->get('com.pinfo.contacto.email', 'admin@pinfo.com.mx') ?></a>
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

    doAjaxPCHItems("/site/get-pch-items");

});


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


    $('#dashboard_refreshss').click(function () {

        doAjaxGetDashboard("/site/get-dashboard");

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


    function doAjaxGetDashboard(filterUrl) {


        $.ajax({
            type: "GET",
            url: filterUrl,
            data: {},
            success: function (result) {

                 $('#general_dashboard').html(result);


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


             		$(function () {
                	  $('[data-toggle="popover-st-quantity"]').popover()
                	})






            },
            beforeSend: function (result) {

            	$('#general_dashboard').html("<img src='/img/loading.gif' /> <p class='text text-info'> Revisando cambios ...</p>");


            },
            error: function (result) {

                $('#general_dashboard').html('Error  ');

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

                $('#comparegridquantity').DataTable({});


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

    	//$('#dashboard_refreshss').trigger('click');
       // $('#syncrequest').trigger('click');
       // $('#ml_syncrequest').trigger('click');
        $('#get_pch_items').trigger('click');
       // $('#ps_syncrequest').trigger('click');
        //$('#request_paridad').trigger('click');




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

        $('#new_product').DataTable({
            'scrollX': false,
            'language': {
                'lengthMenu': 'Display _MENU_ records per page',
                'zeroRecords': 'Nothing found - sorry',
                'info': 'Showing page _PAGE_ of _PAGES_',
                'infoEmpty': 'No records available',
                'infoFiltered': '(filtered from _MAX_ total records)'
            }
        });


        var table =  $('#new_pch_items').DataTable( {
            "ajax": {
                "url": "/site/get-pch-items"


            },
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": "<button class='btn btn-primary'><i class='fa fa-cloud-download'></i>Importar</button>"
            } ]

        } );


        $('#new_pch_items tbody').on( 'click', 'button', function () {
            var button = $(this);
            var data = table.row( $(this).parents('tr') ).data();

            $.ajax({
                url: '/articulo-mayorista/sync-phc-resume-save',
                method: 'POST',
                data: {'Articulo[sku]':data[0],'Articulo[descripcion]':data[1],'Articulo[precio]':data[2],'Articulo[moneda]':data[3],'Articulo[existencia]':data[4],'Articulo[existencia_ps]':data[4]},
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);

                    $(this)
                        .html('Importar Cantidad')
                        .prop('disabled', false);

                    swal({
                        title: 'Ocurrió un error.',
                        text: 'Por favor consulte a su proveedor',
                        type: 'error'
                    });
                },
                success: function (data) {
                    console.log(data);
                    table.row(button.parents("tr")).remove().draw();


                    let timerInterval
                	swal({
                	  title: "Correcto",
                	  html: '<h1><i class="fa fa-thumbs-up"></i></h1>',
                	  timer: 1500,
                	  onClose: () => {
                	    clearInterval(timerInterval)
                	  }
                	}).then((result) => {
                	  if (
                	    // Read more about handling dismissals
                	    result.dismiss === swal.DismissReason.timer
                	  ) {
                	    console.log("I was closed by the timer")
                	  }
                	});





                }
            });


        } );


    });




</script>
<?php JSRegister::end(); ?>