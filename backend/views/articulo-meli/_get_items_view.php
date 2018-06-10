<?php



Yii::$app->formatter->locale = 'es-MX';

if ($items): ?>
			
			
		
				<table class="table table-bordered" id="ml_data_grid" class="display compact" style="width:100%">
					<thead>
						<tr>
    						<th colspan="<?= count($columns = reset( $items) ); ?>">#Total Articulos <?=count($items)?></th>
						</tr>
						<tr>
							<?php foreach ($columns as $key => $val):?>
								<th><?=$key?></th>
							<?php endforeach;?>	
						</tr>
					</thead>
					<tbody>
						<?php foreach($items as $articulo): ?>
						<tr>
						     <?php   foreach ($articulo as $key => $val): ?>
								<td>
									<?php if (is_array($val)):?>
									<?php renderArrayToTable($val);?>
									<?php elseif($key==='precio'):?>
									<?php echo Yii::$app->formatter->asCurrency($val)?>
									<?php else:?>
									<?php echo $val?>
									<?php endif;?>									
								</td>
								<?php endforeach;?>
						</tr>	
					<?php endforeach;?>
					</tbody>
				</table>
		
				
 <?php endif;?>
 
 
 
 
 <?php function renderArrayToTable($value,$printH=false){ 
         if (is_array($value)):?>
            <table class ="table table-condensed"> 
             
             <?php foreach ($value as $key=>$val):?>
             			<tr>
             			
             			<?php if (is_array($val)):?>
            				<?php foreach ($val as $data=>$dataValue): ?>
            				
                				<?php if (!is_array($dataValue)):?>
                				
                				<td><b><?=$data?></b> </td>
                				<td><?=$dataValue?> </td>
                				<?php else:?>
                				<?php 	renderArrayToTable($dataValue); ?>
                				<?php endif;?>
                				
            				<?php endforeach;?>		
            			<?php else:?>
            				
            				<td><b><?=$key?></b> </td>
            				<td><?=$val?> </td>
            			
            			<?php endif;?>	
            					
  						</tr>  				
      		 <?php endforeach;?>					
			           	
            </table> 
            
          <?php endif;?>  
    
<?php }?>