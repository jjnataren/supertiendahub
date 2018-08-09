<?php

use richardfan\widget\JSRegister;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use backend\assets\SwalAsset;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\KeyStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuración servicio PCH Mayoristas';
$this->params['breadcrumbs'][] = $this->title;

SwalAsset::register($this);
$this->registerJsFile('@web/js/swalalert.js', ['depends' => [\yii\web\YiiAsset::class]]);
?>
<div class="row">

    <div class="col-md-12 col-xs-12 col-sm-12">


            <div class="box box-warning with-border">
            <div class="box-header with-border" >
            	<i class="fa fa-cog"></i>
              <h3 class="box-title">Parametros de configuración</h3>

              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="phcMayoristaSync">

				   <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'columns' => [
                    ['class' => SerialColumn::class],

                     'comment',


                    'value',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                //Html::a('borrar', ['cuota-taller/delete','id'=>$key], ['class' => 'bg-red label']);
                                return Html::a('<i class="fa fa-pencil"></i> Editar', ['articulo-mayorista/update-config', 'id' => $model->key],
                                    [
                                        'class' => 'btn btn-primary',
                                        'data-pjax' => '0',
                                        'data' => [
                                            'confirm' => 'Tenga cuidado al actualizar los datos de configuración',
                                            'method' => 'post',
                                        ]
                                    ]);
                            }
                        ]
                    ],


                ],

                'toolbar' =>  [

                    ['content'=> Html::a('<i class="fa fa-chain"></i> Validar PCH', ['validate-pch-online'], ['class' => 'btn btn-primary', 'id'=>'validate-pch',  'title' => 'Validar servicio web'])

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
                'floatHeader' => false,
                'floatHeaderOptions' => ['scrollingTop' => true],
                'panel' => [
                    'type' => GridView::TYPE_WARNING
                ],
            ]);
        } catch (Exception $e) {
            echo 'No se pudo obtener datos';
        } ?>



   			 </div>

     <div class="box-footer">


       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Validar servicio de PCH', null, ['class' => 'btn btn-primary','id'=>'syncrequest']) ?>

     </div>

    </div>



</div>
</div>



<?php JSRegister::begin(); ?>
<script>

$(document).ready(function () {






    $('#validate-pch').click(function (e) {

    	 e.preventDefault();

    	$.ajax({
            url: "validate-pch-online",
            type: "GET",
            data: "",
            beforeSend: function () {
            		$('#validate-pch')
                    .html('Validando <i class="fa fa-spinner fa-spin"></i>')
                    .prop('disabled', true);
            },
            success: function (data) {

            	let timerInterval
            	swal({
            	  title: 'Configuración correcta',
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
            	    console.log('I was closed by the timer')
            	  }
            	})

            },
            error: function (xhr, status, error) {

            	 var err = xhr.responseText ;

                console.log("Error we"  + err);
                swal({
                    title: 'Configuración incorrecta.',
                    text: err,
                    type: 'error'
                });
            },
            complete: function () {

            	$('#validate-pch')
                .html('<i class="fa fa-chain"></i> Validar PCH')
                .prop('disabled', false);


            }
        });

    });



});

</script>
<?php JSRegister::end(); ?>
