<?php

use kartik\grid\GridView;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use backend\models\Articulo;

Yii::$app->formatter->locale = 'es-MX';


/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi tienda';
$this->params['subtitle'] = 'Administración de productos.';
$this->params['titleIcon'] = '<i class="fa fa-mixcloud fa-2x"></i>';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


 <div class="col-md-12" >
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-list"></i>
              <h3 class="box-title">Datos de mi tienda</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="col-md-3">

              <dl>


                <dt><i class="fa fa-industry"></i>  Nombre de mi tienda </dt>
               <dd>Super tienda</dd>

                <dt><i class="fa fa-map-marker"></i> Direccion</dt>
                <dd>Los Reyes la paz, edo. Mex</dd>
               <dt><i class="fa fa-black-tie"></i> Responsable</dt>
                <dd>Omar Mondragón</dd>

                <dt><i class="fa fa-phone"></i> Telefono contacto</dt>
                <dd>+5255 51078305</dd>

              </dl>
             </div>

             <div class="col-md-3">

              <dl>

              	<dt><i class="fa fa-envelope"></i>Correo electrónico</dt>
                <dd>omar@mondragon.com.mx</dd>

                <dt>Ultima actualización</dt>
               <dd><?= ( $articulo =  Articulo::findBySql('select * from tbl_articulo order by ultima_modificacion desc limit 1')->one() ) ? Yii::$app->formatter->asDatetime( $articulo->ultima_modificacion) :  '--'; ?></dd>

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

      <?php echo GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,

                                                'columns' => [


                                                    [
                                                        'attribute'=>'sku',
                                                        'mergeHeader' => false,
                                                        'content'=>function($data){
                                                        return  Html::a( $data->sku, ['articulo/update','id'=>$data->sku]);
                                                        }
                                                        ],

                                                    'descripcion',



                                                    [
                                                        'class' => 'kartik\grid\EditableColumn',
                                                        'refreshGrid' => true,
                                                        'attribute'=>'precio',
                                                        'mergeHeader' => true,
                                                        'content'=>function($data){
                                                        return   Yii::$app->formatter->asCurrency($data->precio);
                                                        }
                                                    ],
                                                    [
                                                        'attribute'=>'moneda',
                                                        'mergeHeader' => true,
                                                        'content'=>function($data){
                                                        return   $data->moneda;
                                                        }
                                                     ],

                                                     [
                                                         'class' => 'kartik\grid\EditableColumn',
                                                         'attribute'=>'tipo_utilidad_ml',
                                                         'mergeHeader' => true,
                                                         'refreshGrid' => true,
                                                         'content'=>function($data){

                                                         return   ($data->tipo_utilidad_ml == 1) ? 'Porcetaje' :  ( ($data->tipo_utilidad_ml == 2)?'monto': null) ;

                                                         },
                                                         'editableOptions'=> [
                                                             'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                                                             'header' => 'Tipo utilidad',
                                                             'asPopover' => true,

                                                             'options' => [
                                                                 'data' =>  [ '1' => 'Porcentaje', '2' => 'Monto'],
                                                             ]
                                                         ],
                                                         'contentOptions' =>['style' => 'border: 1px solid #FFF159'],
                                                         'headerOptions' => ['style' => 'border: 1px solid #FFF159'],

                                                         ],


                                                        [
                                                        'class' => 'kartik\grid\EditableColumn',
                                                        'attribute'=>'utilidad_ml',
                                                            'format' => ['percent'],
                                                            'header'=>'util',
                                                            'refreshGrid' => true,
                                                            'mergeHeader' => true,
                                                        'content'=>function($data){

                                                        return  ($data->tipo_utilidad_ml == 1) ?   Yii::$app->formatter->asPercent($data->utilidad_ml):  ( ($data->tipo_utilidad_ml == 2)?   Yii::$app->formatter->asCurrency($data->utilidad_ml): null) ;

                                                        },
                                                        'contentOptions' =>['style' => 'border: 1px solid #FFF159'],
                                                        'headerOptions' => ['style' => 'border: 1px solid #FFF159'],

                                                        ],


                                                        [

                                                            'header'=>'publico',
                                                            'attribute'=>'utilidad_ml',

                                                            'mergeHeader' => true,
                                                            'content'=>function($data){
                                                                return Yii::$app->formatter->asCurrency (($data->precio*1) +  (($data->tipo_utilidad_ml == 1) ? ($data->precio * $data->utilidad_ml) : (($data->tipo_utilidad_ml == 2) ? $data->utilidad_ml : 0)));
                                                            },
                                                            'contentOptions' =>['style' => 'border: 1px solid #FFF159'],
                                                            'headerOptions' => ['style' => 'border: 1px solid #FFF159'],
                                                            ],



                                                            [
                                                                'class' => 'kartik\grid\EditableColumn',
                                                                'attribute'=>'tipo_utilidad_ps',
                                                                'mergeHeader' => true,
                                                                'refreshGrid' => true,
                                                                'editableOptions'=> [
                                                                    'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                                                                    'header' => 'Tipo utilidad',
                                                                    'asPopover' => true,
                                                                    'options' => [
                                                                        'data' =>  [ '1' => 'Porcentaje', '2' => 'Monto'],
                                                                    ]
                                                                ],

                                                                'content'=>function($data){

                                                                return   ($data->tipo_utilidad_ps == 1) ? 'Porcetaje' :  ( ($data->tipo_utilidad_ps == 2)?'Monto': null) ;

                                                                },
                                                                'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                                'headerOptions' => ['style' => 'border: 1px solid #FF95C5'],

                                                                ],

                                                        [
                                                            'attribute'=>'utilidad_ps',
                                                            'header'=>'util',
                                                            'class' => 'kartik\grid\EditableColumn',
                                                            'refreshGrid' => true,
                                                            'mergeHeader' => true,
                                                            'content'=>function($data){
                                                            return  ($data->tipo_utilidad_ps == 1) ?   Yii::$app->formatter->asPercent($data->utilidad_ps):  ( ($data->tipo_utilidad_ps == 2)?   Yii::$app->formatter->asCurrency($data->utilidad_ps): null) ;
                                                            },


                                                            'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                            'headerOptions' => ['style' => 'border: 1px solid #FF95C5'],
                                                            'editableOptions' => [
                                                                'header' => 'Utilidad prestashop',
                                                            ]


                                                        ],
                                                            [
                                                                'header'=>'publico',
                                                                'attribute'=>'utilidad_ps',
                                                                'mergeHeader' => true,
                                                                'content'=>function($data){
                                                                return Yii::$app->formatter->asCurrency (($data->precio*1) +  (($data->tipo_utilidad_ps == 1) ? ($data->precio * $data->utilidad_ps) : (($data->tipo_utilidad_ps == 2) ? $data->utilidad_ps : 0)));
                                                                },
                                                                'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                                'headerOptions' => ['style' => 'border: 1px solid #FF95C5'],

                                                                ],



                                                                    [
                                                                    'attribute'=>'existencia',
                                                                    'header'=>'PHC',
                                                                    'mergeHeader' => true,
                                                                    'content'=>function($data){
                                                                    return        $data->existencia;
                                                                    }
                                                                    ],

                                                                    [
                                                                        'attribute'=>'existencia_ml',
                                                                        'class' => 'kartik\grid\EditableColumn',
                                                                        'refreshGrid' => true,
                                                                        'header'=>'MLibre',
                                                                        'mergeHeader' => true,
                                                                        'content'=>function($data){
                                                                        return     $data->existencia_ml;
                                                                        },
                                                                        'contentOptions' =>['style' => 'border: 1px solid #FFF159'],
                                                                        'headerOptions' => ['style' => 'border: 1px solid #FFF159'],
                                                                        ],
                                                                        [
                                                                            'attribute'=>'existencia_ps',
                                                                            'class' => 'kartik\grid\EditableColumn',
                                                                            'refreshGrid' => true,
                                                                            'header'=>'PShop',
                                                                            'mergeHeader' => true,
                                                                            'content'=>function($data){
                                                                            return  $data->existencia_ps;
                                                                            },
                                                                            'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                                            'headerOptions' => ['style' => 'border: 1px solid #FF95C5'],
                                                                            ],

                                                                [
                                                                    'header'=>'Tot',
                                                                    'mergeHeader' => true,

                                                                    'content'=>function($data){
                                                                    return   $data->existencia + $data->existencia_ml  +$data->existencia_ps;
                                                                    }
                                                                    ],



                                                ],
                                                'toolbar' =>  [
                                                    ['content'=>
                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>'Reiniciar grid','id'=>'reset_grid'])
                                                    ],
                                                    '{export}',
                                                    '{toggleData}'
                                                ],


                                                'beforeHeader'=>[
                                                    [
                                                        'columns'=>[
                                                            ['content'=>'<i class="fa fa-mixcloud"></i> Articulo', 'options'=>['colspan'=>4, 'class'=>'text text-center',]],
                                                            ['content'=>'<i class="fa fa-truck"></i> Me Libre', 'options'=>['colspan'=>3, 'class'=>'text text-left','style' => 'border: 1px solid #FFF159']],
                                                            ['content'=>'<i class="fa fa-sellsy"></i> PrestaShop', 'options'=>['colspan'=>3, 'class'=>'text text-left','style' => 'border: 1px solid #FF95C5']],
                                                            ['content'=>'<i class="fa fa-database"></i> Existencias', 'options'=>['colspan'=>4, 'class'=>'text text-center' ,'style' => 'border: 2px solid']],
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
                                                'floatHeader' => false,
                                                'floatHeaderOptions' => ['scrollingTop' => true],
                                                'panel' => [
                                                    'type' => GridView::TYPE_PRIMARY
                                                ],
                                            ]); ?>

</div>




	<div class="col-md-12" id="resume">
               <div class="box box-info with-border">
            <div class="box-header with-border" >
            	<i class="fa fa-line-chart"></i>
              <h3 class="box-title">Supertienda cambios</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-refresh"></i>', ['#'], ['class' => 'btn']) ?>

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



       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Actualizar', null, ['class' => 'btn btn-primary','id'=>'syncrequest']) ?>


     </div>

    </div>
    </div>


</div>




 <?php JSRegister::begin(); ?>
<script>





 $('#syncrequest').click(function() {

      doAjax("/articulo/sync-phc-resume");



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

    	                     $('#globalStatus').html((totalChanges>0)?'No sincronizado':'Sincronizado');

    	                     $('#comparegrid').DataTable({
    	                        'scrollX': true,
    	                            });


    	                       $('#sync_success').click(function() {


    	                            doAjax("/articulo/sync-phc-resume?filter=success");

    	                        });

    	                        $('#sync_info').click(function() {


    	                            doAjax("/articulo/sync-phc-resume?filter=danger");

    	                        });


    	                        $('#sync_warning').click(function() {

    	                            doAjax("/articulo/sync-phc-resume?filter=warning");


    	                        });


    	                        $('#sync_all').click(function() {

    	                                                    doAjax("/articulo/sync-phc-resume");


    	                         });


    	                $('[id^=phcform]').on('submit', function(e){
    	                        var form = $(this);
    	                        var formData = form.serialize();

    	                        $.ajax({
    	                            url: form.attr("action"),
    	                            type: form.attr("method"),
    	                            data: formData,
    	                            success: function (data) {
    	                                $('#syncrequest').trigger('click');
    	                                $('#reset_grid').trigger('click');

    	                            },
    	                            error: function () {
    	                                alert("Error al actualizar.");
    	                            }
    	                        });
    	                        e.preventDefault();
    	                    });


    	        }, error: function(result) {

    	             $('#phcMayoristaArt').html('Ha ocurrido un error intente mas tarde ...');

    	        }
    	    });
    	}


      $('#syncrequest').trigger('click');


</script>
<?php JSRegister::end(); ?>
