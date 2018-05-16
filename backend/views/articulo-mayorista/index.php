<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedor PHC Mayoristas';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';





$this->registerJs(
    "


        $('#soaprequest').click(function() {
   
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

                       $('#comparegrid').DataTable({
                        'scrollX': true,                       
                            });
           
        }, error: function(result) {
         
             $('#phcMayoristaSync').html(result);   

        }
    });
});


 $('#soaprequest').trigger('click');
 $('#syncrequest').trigger('click');

",
    View::POS_READY,
    'documentOnLoad'
    );




?>
<div class="row">


 <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
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
                <dd>No sincronizado</dd>
             
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
              <h3 class="box-title">Precios actuales de Articulos <?php echo date("d/M/Y ")?></h3>

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
       			 
       		
       			 
       			  <?php echo Html::a('<i class="fa fa-download"></i> Importar', ['import'], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Al importar un nuevo snapshot podra comparar los productos entre las otras tiendas, sin embargo se descartara el snapshot anterior. ¿Desea continuar?',
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
              <h3 class="box-title">Precios guardados en SUPER TIENDA HUB <?php echo date("d/M/Y H:i:s ")?></h3>

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
            'marca',
            'serie',
            'precio',
            'disponible',
                
            
            

            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class'=>'skip-export']
            ],
            
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="fa fa-plus"></i>', ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>'Nueva']).
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

            'fecha_creacion',
            'nombre',
            'actual',
            'numero_registros',   
            
            

            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class'=>'skip-export']
            ],
            
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="fa fa-plus"></i>', ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>'Nueva']).
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
    </div>
    </div>


     <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
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
       			 
       		
       			 
       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Buscar cambios', ['#'], ['class' => 'btn btn-primary','id'=>'syncrequest']) ?>
       			 
       			  <?php echo Html::a('<i class="fa fa-print"></i> Imprimir', ['print-report'], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'method' => 'get',
                    ],
                ]) ?>
       			 
     </div>
    
    </div>
    </div>

</div>



