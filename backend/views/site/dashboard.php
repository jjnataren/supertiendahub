<?php 

use yii\web\View;
use kartik\grid\GridView;
use richardfan\widget\JSRegister;
use yii\helpers\Html;


$this->title = '  SUPER TIENDA HUB';

$this->registerJs("$('#help1').popover('hide');", View::POS_END, 'my-options1');
$this->registerJs("$('#help2').popover('hide');", View::POS_END, 'my-options2');

Yii::$app->formatter->locale = 'es-MX';


$this->params['subtitle'] = '';

$this->params['titleIcon'] = '
  								<i class="fa fa-mixcloud fa-2x"></i>
							  ';
$this->registerJs("$('#dataTable1').dataTable( {'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json' }});", View::POS_END, 'my-options');


?>
				<!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                      <i class="fa fa-money"></i>
                                       $19.92
                                    </h3>
                                    <p>
                                                                     
                                       Paridad dolar PHC mayoristas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_comision">
                                  Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3>
                                      <i class="glyphicon glyphicon-calendar"></i>
                                               10
                                    </h3>
                                    <p>
                                        Cambios en articulos PHC
                                        
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_supertienda">
                                 Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
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
                                   Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                         <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3> <i class="fa fa-sellsy"></i>  7 </h3>
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
         Articulos de SUPER TIENDA <small>almacenados en base de datos.</small> 
          
                       
          </h4>          
                    
               <div class="row">
               
               
                    
                <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                              		<?php $i=1;?>      
                              
                              
                              		<li><a data-toggle="tab" href="#tab_sync">SUPER TIENDA - PHC</a></li>
                                    <li class="active"><a data-toggle="tab" href="#tab_super_tienda">SUPER TIENDA</a></li>
                                    
                                  
                                    <li class="pull-left header"><i class="fa fa-mixcloud"></i> SUPER TIENDA HUB</li>
                                </ul>
                                <div class="tab-content">
                                  
                                    <div id="tab_super_tienda" class="tab-pane active">
                                        
                                      

                                            <?php echo GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                
                                                
                                                'columns' => [
                                        
                                                    'sku',
                                                    'descripcion',
                                                    [
                                                        'attribute'=>'precio',
                                                        'content'=>function($data){
                                                            return   Yii::$app->formatter->asCurrency($data->precio);
                                                        }
                                                        ],
                                                    
                                                    'marca',
                                                        
                                                    
                                                    
                                        
                                                    ['class' => 'yii\grid\ActionColumn',
                                                        'options'=>['class'=>'skip-export']
                                                    ],
                                                    
                                                ],
                                                'toolbar' =>  [
                                                    ['content'=>
                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                                                    ],
                                                    '{export}',
                                                    '{toggleData}'
                                                ],
                                                
                                              
                                                'beforeHeader'=>[
                                                    [
                                                        'columns'=>[
                                                            ['content'=>'Precios de la ultima imagen tomada', 'options'=>['colspan'=>3, 'class'=>'text text-left']],
                                                            ['content'=>Yii::$app->formatter->asDate(date('Y-m-d')), 'options'=>['colspan'=>2, 'class'=>'text-center']],
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
                                            ]); ?>
                                            
                                    
                                    <p class="text-right">
                                    <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda" data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
						             </button>
                                    <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['comision-mixta-cap/dashboard','id'=>1], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                                    </p>   
                                     </div><!-- /.tab-pane -->
                                     
                                <div id="tab_sync" class="tab-pane">
								
    								<div class="row">
    								<div class="col-md-12">
    								<div class="panel">	
    									<div class="panel-body">
    									<div  id="phcMayoristaSync">
    			
    										<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
    		
       			 						</div>
    									</div>
    									<div class="panel-footer">
    												
           									<a href="#anchor_supertienda" class="btn btn-primary" id="syncrequest">Actualizar </a>
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
			
		<i class="fa fa-truck"></i>	Mercado Libre <small>Almacen de datos, online y comparador.</small> 
          
                       
          </h4>          
                    
               <div class="row">
               
               
                    
                <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                              		<?php $i=1;?>      
                              
                              		<li><a data-toggle="tab" href="#tab_sync">ML HUB - ML Online</a></li>
                                
                              		<li><a data-toggle="tab" href="#tab_sync"><i class="fa fa-exchange"></i>  MercadoLibre HUB - SuperTienda HUB</a></li>
                                    <li><a data-toggle="tab" href="#tab_sync"><i class="fa fa-cloud"></i>  MercadoLibre Online</a></li>
                              	
                                    <li class="active"><a data-toggle="tab" href="#tab_super_tienda"><i class="fa fa-database"> </i> MercadoLibre HUB</a></li>
                                    
                                  
                                    <li class="pull-left header"><i class="fa fa-truck"></i> MercadoLibre HUB</li>
                                </ul>
                                <div class="tab-content">
                                  
                                    <div id="tab_super_tienda" class="tab-pane active">
                                        
                                      

                                            <?php echo GridView::widget([
                                                'dataProvider' => $dataProviderML,
                                                'filterModel' => $searchModelML,
                                                
                                                
                                                'columns' => [
                                        
                                                    'sku',
                                                    'id_meli',
                                                    [
                                                        'attribute'=>'precio',
                                                        'content'=>function($data){
                                                            return   Yii::$app->formatter->asCurrency($data->precio);
                                                        }
                                                        ],
                                                    
                                                    'marca',
                                                        
                                                    
                                                    
                                        
                                                    ['class' => 'yii\grid\ActionColumn',
                                                        'options'=>['class'=>'skip-export']
                                                    ],
                                                    
                                                ],
                                                'toolbar' =>  [
                                                    ['content'=>
                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                                                    ],
                                                    '{export}',
                                                    '{toggleData}'
                                                ],
                                                
                                              
                                                'beforeHeader'=>[
                                                    [
                                                        'columns'=>[
                                                            ['content'=>'Precios de la ultima imagen tomada', 'options'=>['colspan'=>3, 'class'=>'text text-left']],
                                                            ['content'=>Yii::$app->formatter->asDate(date('Y-m-d')), 'options'=>['colspan'=>2, 'class'=>'text-center']],
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
                                            ]); ?>
                                            
                                    
                                    <p class="text-right">
                                    <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda" data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
						             </button>
                                    <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['comision-mixta-cap/dashboard','id'=>1], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                                    </p>   
                                     </div><!-- /.tab-pane -->
                                     
                                <div id="tab_sync" class="tab-pane">
								
    								<div class="row">
    								<div class="col-md-12">
    								<div class="panel">	
    									<div class="panel-body">
    									<div  id="phcMayoristaSync">
    			
    										<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
    		
       			 						</div>
    									</div>
    									<div class="panel-footer">
    												
           									<a href="#anchor_supertienda" class="btn btn-primary" id="syncrequest">Actualizar </a>
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
			
		<i class="fa fa-sellsy"></i>	PrestaShop <small>Almacen de datos, online y comparador.</small> 
          
                       
          </h4>          
                    
               <div class="row">
               
               
                    
                <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                              		<?php $i=1;?>      
                              
                              		<li><a data-toggle="tab" href="#tab_sync">PrestaShop - PrestaShop Online</a></li>
                                
                              		<li><a data-toggle="tab" href="#tab_sync"><i class="fa fa-exchange"></i>  PrestaShop HUB - SuperTienda HUB</a></li>
                                    <li><a data-toggle="tab" href="#tab_sync"><i class="fa fa-cloud"></i>  PrestaShop Online</a></li>
                              	
                                    <li class="active"><a data-toggle="tab" href="#tab_super_tienda"><i class="fa fa-database"> </i> Prestashop HUB</a></li>
                                    
                                  
                                    <li class="pull-left header"><i class="fa fa-sellsy"></i> PrestaShop HUB</li>
                                </ul>
                                <div class="tab-content">
                                  
                                    <div id="tab_super_tienda" class="tab-pane active">
                                        
                                      

                                            <?php echo GridView::widget([
                                                'dataProvider' => $dataProviderPS,
                                                'filterModel' => $searchModelPS,
                                                
                                                
                                                'columns' => [
                                        
                                                    'sku',
                                                    'id_prestashop',
                                                    [
                                                        'attribute'=>'precio',
                                                        'content'=>function($data){
                                                            return   Yii::$app->formatter->asCurrency($data->precio);
                                                        }
                                                        ],
                                                    
                                                    'marca',
                                                        
                                        
                                                    ['class' => 'yii\grid\ActionColumn',
                                                        'options'=>['class'=>'skip-export']
                                                    ],
                                                    
                                                ],
                                                'toolbar' =>  [
                                                    ['content'=>
                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                                                    ],
                                                    '{export}',
                                                    '{toggleData}'
                                                ],
                                                
                                              
                                                'beforeHeader'=>[
                                                    [
                                                        'columns'=>[
                                                            ['content'=>'Precios de la ultima imagen tomada', 'options'=>['colspan'=>3, 'class'=>'text text-left']],
                                                            ['content'=>Yii::$app->formatter->asDate(date('Y-m-d')), 'options'=>['colspan'=>2, 'class'=>'text-center']],
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
                                            ]); ?>
                                            
                                    
                                    <p class="text-right">
                                    <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda" data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
						             </button>
                                    <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['comision-mixta-cap/dashboard','id'=>1], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                                    </p>   
                                     </div><!-- /.tab-pane -->
                                     
                                <div id="tab_sync" class="tab-pane">
								
    								<div class="row">
    								<div class="col-md-12">
    								<div class="panel">	
    									<div class="panel-body">
    									<div  id="phcMayoristaSync">
    			
    										<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
    		
       			 						</div>
    									</div>
    									<div class="panel-footer">
    												
           									<a href="#anchor_supertienda" class="btn btn-primary" id="syncrequest">Actualizar </a>
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
            <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs" data-original-title="Remove"><i class="fa fa-times"></i></button>
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
            <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs" data-original-title="Remove"><i class="fa fa-times"></i></button>
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
									  <br />
									 
									  
									</address>
									<h4>
                                	<i class="fa fa-twitter"></i>
									  <a href="<?= Yii::$app->keyStorage->get('com.pinfo.contacto.tw', '') ?>" target="blank"><?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '@pizo') ?></a>
                                	</h4>
                                </div>
                                </div>
                                </div>
                                </div>





<?php JSRegister::begin(); ?>
<script>

$('#soaprequest').click(function() {

  $('#phcMayoristaArt').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>");

$.ajax({
type: 'POST',
url: '/articulo-mayorista/soap-req',
data: {

}, success: function(result) {

             $('#phcMayoristaArt').html(result);

               $('#datagrid').DataTable({
                'scrollX': true,
                'language': {
                            'lengthMenu': 'Display _MENU_ records per page',
                            'zeroRecords': 'Nothing found - sorry',
                            'info': 'Showing page _PAGE_ of _PAGES_',
                            'infoEmpty': 'No records available',
                            'infoFiltered': '(filtered from _MAX_ total records)'
                        }
                    });

}, error: function(result) {
     $('#phcMayoristaArt').html('Ha ocurrido un error intente mas tarde ...');
}
});
});


$('#syncrequest').click(function() {

    doAjax("/articulo/sync-phc-resume?dashboard=true");

});



function doAjax(filterUrl) {

$('#phcMayoristaSync').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>");    

$.ajax({
type: "GET",
url: filterUrl,
data: {

}, success: function(result) {


             $('#phcMayoristaSync').html(result);

             var totalChanges = $('#totalChanges').val();


             $('#comparegrid').DataTable({
                
                    });

              
               $('#sync_success').click(function() {


                    doAjax("/articulo/sync-phc-resume?filter=success&dashboard=true");
                    
                });

                $('#sync_info').click(function() {
                    

                    doAjax("/articulo/sync-phc-resume?filter=info&dashboard=true");
                    
                });


                $('#sync_warning').click(function() {

                    doAjax("/articulo/sync-phc-resume?filter=warning&dashboard=true");

                    
                });


                $('#sync_all').click(function() {
                    
                                            doAjax("/articulo/sync-phc-resume?dashboard=true");
                
                                            
                 });




}, error: function(result) {

     $('#phcMayoristaArt').html('Ha ocurrido un error intente mas tarde ...');

}
});
}

$( document ).ready(function() {
	$('#syncrequest').trigger('click');
});




</script>
<?php JSRegister::end(); ?>                                