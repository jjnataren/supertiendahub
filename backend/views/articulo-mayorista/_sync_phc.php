<?php



Yii::$app->formatter->locale = 'es-MX';


$changes=[];
?>


			
						
				 <div class="col-md-9">	
				 
				
				<table class="table table-hover table-bordered" id="comparegrid"   style="width:100%">
					<thead>
						<tr>
							
								<th>sku</th>
								<th>Descripción</th>
								<th />
								<th>Precio SUPER TIENDA</th>
								<th>Precio PHC Mayorista</th>
								<th>Moneda</th>
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
    						     <td><i class="fa <?=( ($art_status == 'info')?'fa-opencart': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['dbmodel']->precio)?$item['dbmodel']->precio:''  )?></td>
    						     <td><?= Yii::$app->formatter->asCurrency( !strcmp($item['model']->moneda, 'USD') ?  ( isset($item['model']->precio)?$item['model']->precio:0)  * $paridad  : $item['model']->precio)?></td>
    						     <!-- TODO: Asignar el valod de moneda en variable global -->
    						     <td><?= isset($item['model']->moneda)?$item['model']->moneda:'' ?> &nbsp; 
    						     <?=  (isset($item['model']->moneda) && !strcmp($item['model']->moneda, 'USD') )? Yii::$app->formatter->asCurrency( $item['model']->precio ):''?>  </td>
    						     
    						     <td> <?=( ($art_status == 'info')?'Nuevo': ( ($art_status=='warning')?'Bajo':'Subio' )  )?>  </td>
    						   
                              
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
 
 

 
 
