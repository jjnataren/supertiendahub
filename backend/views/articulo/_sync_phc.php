<?php



Yii::$app->formatter->locale = 'es-MX';


$changes=[];
?>


<div class="row">
			
						
				 <div class="col-md-9 col-xs-12 col-sm-12">	
				 
				
				<table class="table" id="comparegrid" >
					<thead>
						<tr>
							
								<th>sku</th>
								<th>Descripción</th>
								<th> </th>
								<th>Precio SUPER TIENDA</th>
								<th>Precio PHC Mayorista</th>
								<th>Moneda</th>
								
						</tr>
					</thead>
					<tbody>
					
						<?php if($articles): ?>
						<?php    foreach($articles as $key=>$item): ?>
						
						<?php if (  !strcmp(  ($art_status =  !isset($item['model']) ? 'danger' : ( ($item['dbmodel']->precio < $item['model']->precio) ?'success':'warning' ) ), $filter ) || !$filter  ) :?>
						
						
    						<tr class="<?=$art_status  ?>" >
    						
    						     <td><?= $key ?> </td>
    						     <td><?= isset($item['model']->descripcion)?$item['model']->descripcion:'' ?></td>
    						     <td><i class="fa <?=( ($art_status == 'info')?'fa-opencart': ( ($art_status=='warning')?'fa-level-down':'fa-level-up' )  )?>"></i> </td>
    						     <td><?= Yii::$app->formatter->asCurrency(isset($item['dbmodel']->precio)?$item['dbmodel']->precio:''  )?></td>
    						     <td><?= ($item['model'])?  ( Yii::$app->formatter->asCurrency(( isset($item['model']->precio) &&  isset($item['model']->moneda) && !strcmp($item['model']->moneda, 'USD') )  ?  ( isset($item['model']->precio)?$item['model']->precio:0)  * $paridad  : $item['model']->precio)) : '-' ?></td>
    						     <!-- TODO: Asignar el valod de moneda en variable global -->
    						     <td><?= isset($item['model']->moneda)?$item['model']->moneda:'' ?> &nbsp; 
    						     <?=  (isset($item['model']->moneda) && !strcmp($item['model']->moneda, 'USD') )? Yii::$app->formatter->asCurrency( $item['model']->precio ):''?>  </td>
                              
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
                            			 
                            				<i class="fa fa-money"></i> &nbsp;Paridad dolar  
									</div>
							</div>
						</div>			
            					 	
						</div>
 </div>
 

 
 
