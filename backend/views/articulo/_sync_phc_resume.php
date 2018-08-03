<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->formatter->locale = 'es-MX';


$changes=[];
?>




				 <div class="col-md-9">


				<table class="table table-hover table-bordered" id="comparegrid"   style="width:100%">
					<thead>
						<tr>

								<th>SKU</th>
								<th>Descripción</th>
								<th />
								<th>$ ST</th>
								<th>$ PCH</th>
								<th />
						</tr>
					</thead>
					<tbody>

						<?php if($articles): ?>
						<?php    foreach($articles as $key=>$item): ?>

						<?php if (  !strcmp(  ($art_status =  !isset($item['model']) ? 'danger' : ( ($item['dbmodel']->precio < $item['model']->precio) ?'success':'warning' ) ), $filter ) || !$filter  ) :?>


    						<tr class="<?=$art_status  ?>" >

    						     <td><?= $key ?> </td>
    						     <td><?= isset($item['dbmodel']->descripcion)?$item['dbmodel']->descripcion:'' ?></td>
    						     <td><i class="fa <?=( ($art_status == 'danger')?'fa-question-circle': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['dbmodel']->precio)?$item['dbmodel']->precio  :''  ) . ' ' .  $item['dbmodel']->moneda?></td>
    						     <td><?= ($item['model'])?  ( Yii::$app->formatter->asCurrency(( isset($item['model']->precio) &&  isset($item['model']->moneda)  )  ?  ( isset($item['model']->precio)?$item['model']->precio:0)   : $item['model']->precio)).  ' ' .  $item['model']->moneda : '-' ?></td>
    						     <!-- TODO: Asignar el valod de moneda en variable global -->
    						   	 <td>

							<?php if($art_status !=='danger'):?>

    							<?php $form = ActiveForm::begin(['action' => ['sync-phc-resume-save'], 'method'=>'post', 'options' => ['id'=>'phcform_'.$key ]]); ?>


    						     	 <?php echo $form->field($item['model'], 'sku')->hiddenInput(['maxlength' => true])->label(false); ?>
    						     	 <?php echo $form->field($item['model'], 'precio')->hiddenInput()->label(false); ?>
									 <?php echo $form->field($item['model'], 'moneda')->hiddenInput()->label(false); ?>




    						      <?=  Html::submitButton(($art_status == 'danger')?'<i class="fa fa-cloud-download"></i> Importar ' :
    						             ( ($art_status == 'warning')? '<i class="fa fa-warning"></i> Actualizar' : '<i class="fa fa-thumbs-o-up"></i> Actualizar'  ),  ['class' =>'btn btn-' .$art_status ])  ?>

    						    <?php ActiveForm::end(); ?>


    						    <?php else:?>

    						    <?php $form = ActiveForm::begin(['action' => ['sync-phc-resume-save'], 'method'=>'post', 'options' => ['id'=>'phcform_'.$key ]]); ?>


    						     	 <?php echo $form->field($item['dbmodel'], 'sku')->hiddenInput()->label(false); ?>

									 <?php echo $form->field($item['dbmodel'], 'existencia')->hiddenInput(['value' => 0])->label(false); ?>

									 <?php echo $form->field($item['dbmodel'], 'existencia_ml')->hiddenInput(['value' => 0])->label(false); ?>

									 <?php echo $form->field($item['dbmodel'], 'existencia_ps')->hiddenInput(['value' => 0])->label(false); ?>



    						      <?=  Html::submitButton(($art_status == 'danger')?'<i class="fa fa-thumbs-down"></i> Actualizar ' :
    						             ( ($art_status == 'warning')? '<i class="fa fa-warning"></i> Actualizar' : '<i class="fa fa-thumbs-o-up"></i> Actualizar'  ),  ['class' =>'btn btn-' .$art_status ])  ?>

    						    <?php ActiveForm::end(); ?>



							<?php endif;?>

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

				      <div class="col-md-3">


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
                      	<?php if(!strcmp($filter, 'danger')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>

                       		  <span class="label label-danger">
                               <?=isset($vals['danger'])?$vals['danger']:'0'?>
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-question-circle"></i><a href="#resume" id="sync_info" > No existe info </a>



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





