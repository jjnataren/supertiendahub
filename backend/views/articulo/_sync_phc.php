<?php



Yii::$app->formatter->locale = 'es-MX';


$changes=[];
?>


<div class="row">


				 <div class="col-md-9 col-xs-12 col-sm-12">


				<table class="table" id="comparegrid" >
					<thead>
						<tr>

								<th rowspan="2">SKU</th>
								<th rowspan="2">Descripción</th>
								<th rowspan="2"> </th>
								<th><i class="fa fa-mixcloud"></i> Super Tienda</th>
								<th><i class="fa fa-cart-arrow-down"></i> PCH</th>


						</tr>
						<tr>
								<th><i class="fa fa-dollar"></i></th>
								<th><i class="fa fa-dollar"></i></th>
						</tr>
					</thead>
					<tbody>

						<?php if($articles): ?>
						<?php    foreach($articles as $key=>$item): ?>

						<?php if (  !strcmp(  ($art_status =  !isset($item['model']) ? 'danger' : ( ($item['dbmodel']->precio < $item['model']->precio) ?'success':'warning' ) ), $filter ) || !$filter  ) :?>

						<?php

						$precioST = '';

						  if ( isset($item['dbmodel']->precio) )
						          if (  isset($item['dbmodel']->moneda) && $item['dbmodel']->moneda == 'USD'  )
						              $precioST =  round ($item['dbmodel']->precio * $paridad,2).' MN <br /><i>(' . $item['dbmodel']->precio . ' USD)</i>'   ;
						          else
						              $precioST = round($item['dbmodel']->precio,2)  . ' MN';

						  ?>

    						<tr class="<?=$art_status;  ?>" >

    						     <td><?= $key ?> </td>
    						     <td><?= isset($item['dbmodel']->descripcion)?$item['dbmodel']->descripcion:'' ?></td>
    						     <td><i class="fa <?=( ($art_status == 'danger')?'fa-question-circle': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= $precioST  ?></td>
    						     <td><?= ($item['model'])?  $item['model']->precio .' ' .$item['model']->moneda  : '-' ?></td>
    						     <!-- TODO: Asignar el valod de moneda en variable global -->

    						</tr>

    					<?php endif;?>

    					<?php $changes[] = $art_status; ?>
						<?php endforeach;?>

					 <?php else:?>


					 	<tr class="info" >

    						     <td colspan="7"><h4>Sin cambios.</h4></td>

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
                            <span class="label label-default">
                               <?=$total_changes = count($articles)?>
                               <input type="hidden" id="totalChanges" value ="<?= $total_changes ?>" >
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-sync"></i><a  href="#resume" id="sync_all">Productos cambiaron   </a>
                      </p>
                      <p>
                      	<?php if(!strcmp($filter, 'info')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>

                       		  <span class="label label-danger">
                               <?=isset($vals['info'])?$vals['info']:'0'?>
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-close"></i>

                       		<?php if(isset($vals['info'] ) &&  $vals['info'] > 0 ):  ?>
                       		<a href="#resume" id="sync_info" > No existe info </a>

                       		<?php else:?>

                       			No existe info

                       			<?php endif;?>


						</p>
						<p>
							<?php if(!strcmp($filter, 'success')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                      		  <span class="label label-success">
                               <?=isset($vals['success'])?$vals['success']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-up"></i>
                       			<?php if(isset($vals['success'] ) &&  $vals['success'] > 0 ):  ?>

                       				<a href="#resume" id="sync_success"  >Subierón de precio</a>

                       			<?php else:?>

                       				Subierón de precio

                       			<?php endif;?>

						</p>
						<p>
							<?php if(!strcmp($filter, 'warning')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                       		  <span class="label label-warning">
                               <?=isset($vals['warning'])?$vals['warning']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-down"></i>

                       			<?php if(isset($vals['warning'] ) &&  $vals['warning'] > 0 ):  ?>

	                       			<a href="#resume"  id="sync_warning" > Bajaron de precio   </a>

                       			<?php else:?>

                       				Bajaron de precio

                       			<?php endif;?>

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

                            				<i class="fa fa-money"></i> &nbsp;Precio dolar
									</div>
							</div>
						</div>

						</div>
 </div>


<h4 class="page-header">
    Cambio de catidades
    <small>Supertienda - Proveedor PCH</small>
</h4>

<div class="row">

 <div class="col-md-9 col-xs-12 col-sm-12">


				<table class="table" id="comparegridquantity" >
					<thead>



						<tr>

								<th rowspan="2">SKU</th>
								<th rowspan="2">Descripción</th>
								<th rowspan="2"> </th>
								<th><i class="fa fa-mixcloud"></i> Super Tienda</th>
								<th><i class="fa fa-cart-arrow-down"></i> PCH</th>


						</tr>
						<tr>
								<th><i class="fa fa-cubes"></i></th>
								<th><i class="fa fa-cubes"></i></th>
						</tr>
					</thead>
					<tbody>

						<?php if($articles): ?>
						<?php    foreach($articles as $key=>$item): ?>

						<?php if (  !strcmp(  ($art_status =  !isset($item['model']) ? 'danger' : ( ($item['dbmodel']->existencia*1 == $item['model']->existencia*1 ) ?'success':'warning' ) ), $filter ) || !$filter  ) :?>

    						<tr class="<?=$art_status;  ?>" >

    						     <td><?= $key ?> </td>
    						     <td><?= isset($item['dbmodel']->descripcion)?$item['dbmodel']->descripcion:'' ?></td>
    						     <td><i class="fa <?=( ($art_status == 'danger')?'fa-question-circle': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= isset($item['dbmodel']->existencia)?$item['dbmodel']->existencia:'--';  ?></td>
    						     <td><?= isset($item['model']->existencia)?$item['model']->existencia:'--';  ?></td>
    						      <!-- TODO: Asignar el valod de moneda en variable global -->

    						</tr>

    					<?php endif;?>

    					<?php $changes[] = $art_status; ?>
						<?php endforeach;?>

					 <?php else:?>


					 	<tr class="info" >

    						     <td colspan="7"><h4>Sin cambios.</h4></td>

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
                            <span class="label label-default">
                               <?=$total_changes = count($articles)?>
                               <input type="hidden" id="totalChanges" value ="<?= $total_changes ?>" >
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-sync"></i><a  href="#resume" id="sync_all">Productos cambiaron   </a>
                      </p>
                      <p>
                      	<?php if(!strcmp($filter, 'info')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>

                       		  <span class="label label-danger">
                               <?=isset($vals['info'])?$vals['info']:'0'?>
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-close"></i>

                       		<?php if(isset($vals['info'] ) &&  $vals['info'] > 0 ):  ?>
                       		<a href="#resume" id="sync_info" > No existe info </a>

                       		<?php else:?>

                       			No existe info

                       			<?php endif;?>


						</p>
						<p>
							<?php if(!strcmp($filter, 'success')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                      		  <span class="label label-success">
                               <?=isset($vals['success'])?$vals['success']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-up"></i>
                       			<?php if(isset($vals['success'] ) &&  $vals['success'] > 0 ):  ?>

                       				<a href="#resume" id="sync_success"  >Cambiaron de cantidad</a>

                       			<?php else:?>

                       				Subierón de precio

                       			<?php endif;?>

						</p>
						<p>
							<?php if(!strcmp($filter, 'warning')):?>
                      		<i class="fa fa-angle-left pull-right"></i>
                      		<?php endif;?>
                       		  <span class="label label-warning">
                               <?=isset($vals['warning'])?$vals['warning']:0?>
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-down"></i>

                       			<?php if(isset($vals['warning'] ) &&  $vals['warning'] > 0 ):  ?>

	                       			<a href="#resume"  id="sync_warning" > Bajaron de precio   </a>

                       			<?php else:?>

                       				Bajaron de precio

                       			<?php endif;?>

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

                            				<i class="fa fa-money"></i> &nbsp;Precio dolar
									</div>
							</div>
						</div>

						</div>


</div>



