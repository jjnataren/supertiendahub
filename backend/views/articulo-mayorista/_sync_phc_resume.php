<?php
Yii::$app->formatter->locale = 'es-MX';

if ($articles): ?>
			
						
				 <div class="col-md-9">		
				<table class="table table-hover table-bordered" id="comparegrid"   style="width:100%">
					<thead>
						<tr>
							
								<th>sku</th>
								<th>Seccion</th>
								<th />
								<th>Precio SUPER TIENDA</th>
								<th>Precio PHC Mayorista</th>
								<th />
						</tr>
					</thead>
					<tbody>
						<?php    foreach($articles as $key=>$item): ?>
						
							<?php ?>
						
    						<tr class="<?= ($art_status =  !isset($item['dbmodel']) ? 'info' : ( ($item['dbmodel']->precio < $item['model']->precio) ?'success':'warning' )) ?>" >
    						     <td><?= $key ?></td>
    						     <td><?= isset($item['model']->descripcion)?$item['model']->descripcion:'' ?></td>
    						     <td><i class="fa <?=( ($art_status == 'info')?'fa-opencart': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['dbmodel']->precio)?$item['dbmodel']->precio:''  )?></td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['model']->precio)?$item['model']->precio:'')?></td>
    						     <td> <?=( ($art_status == 'info')?'Nuevo': ( ($art_status=='warning')?'Bajo':'Subio' )  )?> </td>
    							 
    							 <?php $changes[] = $art_status; ?>
    						</tr>	
						<?php endforeach;?>
					</tbody>
				</table>
				</div>
				
				      <div class="col-md-3"> 
				      <div class="panel panel-default">
				      <div class="panel-body">
				      <?php $vals = array_count_values($changes);?>
				      <p>
                            <span class="label label-danger">
                               <?=$total_changes = count($articles)?> 
                               <input type="hidden" id="totalChanges" value ="<?= $total_changes ?>" >           
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-sync"></i> Productos cambiaron   
                      </p>
                      <p> 		 
                       		  <span class="label label-info">
                               <?=isset($vals['info'])?$vals['info']:'0'?>            
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-opencart"></i> Nuevos   
					
						</p>
						<p> 		 
                       		  <span class="label label-success">
                               <?=isset($vals['success'])?$vals['success']:0?>            
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-up"></i> Subieron de precio   
					
						</p>
						<p> 		 
                       		  <span class="label label-warning">
                               <?=$vals['warning']?>            
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-down"></i> Bajaron de precio   
					
						</p>
						</div>
						</div>
						</div>
					 	
 <?php endif;?>
 
 
 
 
