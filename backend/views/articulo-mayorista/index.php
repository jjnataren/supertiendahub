<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use backend\models\ArticuloMayoristaSnap;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedor PHC Mayoristas';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';





$this->registerJs(
    "
    
    
        $('#soaprequest').click(function() {
    
          $('#phcMayoristaArt').html(\"<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>\");
    
   $.ajax({
        type: \"POST\",
        url: \"/articulo-mayorista/soap-req\",
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
             $('#phcMayoristaArt').html(result);
        }
    });
});
    
    
       $('#syncrequest').click(function() {
    
    
    
   $.ajax({
        type: \"POST\",
        url: \"/articulo-mayorista/sync-phc-resume\",
        data: {
    
        }, success: function(result) {
    
    
    
                     $('#phcMayoristaSync').html(result);
    
                        var totalChanges = $('#totalChanges').val();
    
    
    
                      $('#globalStatus').html((totalChanges>0)?'No sincronizado':'Sincronizado');
    
                       $('#comparegrid').DataTable({
                        'scrollX': true,
                            });
    
        }, error: function(result) {
    
             $('#phcMayoristaSync').html(result);
    
        }
    });
});
    
$('#syncrequest').trigger('click');
 $('#soaprequest').trigger('click');
    
    
",
    View::POS_READY,
    'documentOnLoad'
    );




?>
<div class="row">


 <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-cart-arrow-down"></i>
              <h3 class="box-title">Proveedor</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          
              <div class="col-md-3">
				
              <dl>
              
             
                <dt>Nombre del proveedor </dt>
               <dd>PHC Mayorista</dd>
                
                <dt>Direccion</dt>
                <dd>Ciudad de Mexico</dd>
               <dt><i class="fa fa-black-tie"></i> Responsable</dt>
              
                <dd>Jhon doe</dd>
                <dt><i class="fa fa-phone"></i> Telefono contacto</dt>
              
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
       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Buscar cambios', ['#'], ['class' => 'btn btn-primary','id'=>'soaprequest']) ?>
            </div>
            </div>
           
            <!-- /.box-body -->
          </div>



     <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Precios publicados en PHC Mayoristas  <?php echo date("d/M/Y H:i:s ")?></h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="phcMayoristaArt">
			
				<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
		
   			 </div>
    
     <div class="box-footer">
       			 
     </div>
    
    </div>
    </div>
    



	<div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-line-chart"></i>
              <h3 class="box-title">Resumen de cambios</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-refresh"></i>', ['sync-phc-resume'], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="phcMayoristaSync">
			
				<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
		
   			 </div>
    
     <div class="box-footer">
       			 
       		
       			 
       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Actualizar', ['#'], ['class' => 'btn btn-primary','id'=>'syncrequest']) ?>
       			 
       			  <?php echo Html::a('<i class="fa fa-refresh"></i> Sincronizar SUPER TIENDA y PHC', ['import'], ['class' => 'btn btn-success','data' => [
                        'confirm' => 'Al sincronizar las fuentes de datos, se descartaran los precios de la versión anterior, sin embargo se guardara un respaldo del estado actual.',
                        'method' => 'post',
                    ],]) ?>
       			
       			 
       			  <?php echo Html::a('<i class="fa fa-print"></i> Imprimir', ['print-report'], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'method' => 'get',
                    ],
                ]) ?>
       			 
     </div>
    
    </div>
    </div>



 
     <div class="col-md-12">
               <div class="box box-primary with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Articulos actuales en SUPER TIENDA HUB  [<b><?=ArticuloMayoristaSnap::findOne(['actual'=>1])->nombre?></b>]</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">





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
    
    </div>
    
    <div class="box-footer">
      <?php echo Html::a('<i class="fa fa-camera"></i> Generar imagen', ['generate-snap'], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Se descartara la imagen anterior. ¿Desea continuar?',
                        'method' => 'post',
                    ],
                ]) ?>
                
     </div>           
    </div>
    </div>



 
     <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Historial de imagenes guardadas </h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">





    <?php echo GridView::widget([
        'dataProvider' => $snapDataProvider,
        'filterModel' => $searchSnapModel,
        
        
        'columns' => [

           
            'nombre',
            'fecha_creacion',
           
            
                [
                'attribute'=>'actual',
                'content'=>function($data){
                    return  ($data->actual)?'Actual':'No';
                },
                'filter'=>[0=>'No', 1=>'Actual'],
                ],
            
            'numero_registros',   
            
            

         
            
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    
                    'view' => function ($url, $model, $key) {
                         //Html::a('borrar', ['cuota-taller/delete','id'=>$key], ['class' => 'bg-red label']);
                        return Html::a('<i class="fa fa-tachometer"></i> Seleccionar', ['select-snap', 'id'=>$model->id], 
                            [
                                'class' => 'btn btn-primary',
                                'data-pjax' => '0',
                                'data' => [
                                'confirm' => '¿Al seleccionar esta imagen podra compara los precios con las demas tiendas?',
                                'method' => 'post',
                            ]
                        ]);
                    }
                    ]
                    
                    
            ]
            
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}'
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
    
    </div>
    </div>
    </div>


     

</div>



