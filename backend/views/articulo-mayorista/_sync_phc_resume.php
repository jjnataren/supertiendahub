<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->formatter->locale = 'es-MX';


$changes=[];
?>




				 <div class="col-md-10">


				<table class="table table-hover table-bordered" id="comparegrid"   style="width:100%">
					<thead>
						<tr>

								<th>sku</th>
								<th>Descripción</th>
								<th />
								<th>$ Mi tienda</th>
								<th>$ PCH</th>
								<th>Moneda</th>
								<th># Mi tienda</th>
								<th># Mi PCH</th>
								<th />
						</tr>
					</thead>
					<tbody>

						<?php if($articles): ?>
						<?php    foreach($articles as $key=>$item): ?>

						<?php if (  !strcmp(  ($art_status =  !isset($item['dbmodel']) ? 'info' : ( ($item['dbmodel']->precio < $item['model']->precio) ?'success':'warning' ) ), $filter ) || !$filter  ) :?>


    						<tr class="<?=$art_status  ?>" >

    						     <td><?= $key ?> </td>
    						     <td><?= isset($item['model']->descripcion)?$item['model']->descripcion:'' ?></td>
    						     <td>
	    						     <?=( ($art_status == 'info')?'Nuevo': ( ($art_status=='warning')?'Bajo':'Subio' )  )?>
    							     <i class="fa <?=( ($art_status == 'info')?'fa-opencart': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i>
    						     </td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['dbmodel']->precio)?$item['dbmodel']->precio:''  )?></td>
    						     <td><?= Yii::$app->formatter->asCurrency( !strcmp($item['model']->moneda, 'USD') ?  ( isset($item['model']->precio)?$item['model']->precio:0)  * $paridad  : $item['model']->precio)?></td>
    						     <!-- TODO: Asignar el valod de moneda en variable global -->
    						     <td><?= isset($item['model']->moneda)?$item['model']->moneda:'' ?> &nbsp;
    						    	 <?=  (isset($item['model']->moneda) && !strcmp($item['model']->moneda, 'USD') )? Yii::$app->formatter->asCurrency( $item['model']->precio ):''?>
    						      </td>

    						     <td> <?=isset($item['dbmodel']->existencia)?$item['dbmodel']->existencia:'0'   ?></td>
    						     <td> <?=isset($item['model']->existencia)?$item['model']->existencia:'--'   ?></td>
    						     <td>

    							<?php $form = ActiveForm::begin(['action' => ['sync-phc-resume-save'], 'method'=>'post', 'options' => ['id'=>'phcform_'.$key ]]); ?>


    						     	 <?php echo $form->field($item['model'], 'sku')->hiddenInput()->label(false); ?>
    						     	 <?php echo $form->field($item['model'], 'precio')->hiddenInput()->label(false); ?>
									 <?php echo $form->field($item['model'], 'existencia')->hiddenInput()->label(false); ?>
									 <?php echo $form->field($item['model'], 'descripcion')->hiddenInput()->label(false); ?>
    						     	 <?php echo $form->field($item['model'], 'serie')->hiddenInput()->label(false); ?>
									 <?php echo $form->field($item['model'], 'peso')->hiddenInput()->label(false); ?>
									  <?php echo $form->field($item['model'], 'moneda')->hiddenInput()->label(false); ?>
									  <?php echo $form->field($item['model'], 'seccion')->hiddenInput()->label(false); ?>
									  <?php echo $form->field($item['model'], 'alto')->hiddenInput()->label(false); ?>
									  <?php echo $form->field($item['model'], 'largo')->hiddenInput()->label(false); ?>
									  <?php echo $form->field($item['model'], 'ancho')->hiddenInput()->label(false); ?>
										<?php echo $form->field($item['model'], 'marca')->hiddenInput()->label(false); ?>
									 <?php echo $form->field($item['model'], 'linea')->hiddenInput()->label(false); ?>

    						      <?=  Html::submitButton(($art_status == 'info')?'<i class="fa fa-cloud-download"></i> Importar ' :
    						             ( ($art_status == 'warning')? '<i class="fa fa-warning"></i> Actualizar' : '<i class="fa fa-thumbs-o-up"></i> Actualizar'  ),  ['class' =>'btn btn-' .$art_status,'onclick'=>'$("#phcform_'.$key.'").submit(function(e) {



                        var form = $(this);
                       var formData = form.serialize();

                       $.ajax({
                           url: form.attr("action"),
                           type: "POST",//form.attr("post"),
                           data: formData,
                           beforeSend: function () {
                           	form.find(":submit")
                                   .html(\'Aplicando <i class="fa fa-spinner fa-spin"></i>\')
                                   .prop("disabled", true);
                           },
                           success: function (data) {

                         	  var table = $("#comparegrid").DataTable();
     	                          table
     	                             .row( form.parents("tr") )
     	                             .remove()
     	                             .draw();

                           },
                           error: function () {
                         	  console.log(msg);
                               swal({
                                   title: "Servicio no disponible por el momento.",
                                   text: "Por favor consulte a su proveedor",
                                   type: "error"
                               });
                           },
                           complete: function () {
                           	let timerInterval
                           	swal({
                           	  title: "Correcto",
                           	  html: \'<h1><i class="fa fa-thumbs-up"></i></h1>\',
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
                           	})
                           }
                       });

                    e.preventDefault();


});' ])  ?>

    						    <?php ActiveForm::end(); ?>



    						       </td>



    						</tr>

    					<?php endif;?>

    					<?php $changes[] = $art_status; ?>
						<?php endforeach;?>

					 <?php else:?>


					 	<tr class="info" >

    						     <td colspan="6"><h4>Sin cambios.</h4></td>

    					</tr>

					 <?php endif;?>
					</tbody>
				</table>

				</div>

				      <div class="col-md-2">


				    <div class="col-md-12">

				      <div class="panel panel-default">


				      <div class="panel-body">
				      <?php $vals = array_count_values($changes);?>
				      <p>
                            <span class="label label-danger">
                               <?=$total_changes = count($articles)?>
                               <input type="hidden" id="totalChanges" value ="<?= $total_changes ?>" >
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-sync"></i><a  href="#resume" id="sync_all">Productos cambiaron   </a>
                      </p>
                      <p>
                      	<?php if(!strcmp($filter, 'info')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>

                       		  <span class="label label-info">
                               <?=isset($vals['info'])?$vals['info']:'0'?>
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-opencart"></i><a href="#resume" id="sync_info" > Nuevos </a>



						</p>
						<p>
							<?php if(!strcmp($filter, 'success')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                      		  <span class="label label-success">
                               <?=isset($vals['success'])?$vals['success']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-up"></i> <a href="#resume" id="sync_success"  >Subierón de precio</a>

						</p>
						<p>
							<?php if(!strcmp($filter, 'warning')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                       		  <span class="label label-warning">
                               <?=isset($vals['warning'])?$vals['warning']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-down"></i><a href="#resume"  id="sync_warning" > Bajaron de precio   </a>

						</p>
						</div>

						</div>
						</div>

					 	 <div class="col-md-12">

					 	   <div class="panel panel-default">



            				      <div class="panel-body">
            				    	    <span class="label label-primary">
                               				<?=isset($paridad)?$paridad: '--'?>
                            			 </span> &nbsp;

                            				<i class="fa fa-money"></i> &nbsp;Paridad dolar
									</div>
							</div>
						</div>

						</div>





