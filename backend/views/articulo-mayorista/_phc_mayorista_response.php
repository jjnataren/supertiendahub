<?php



Yii::$app->formatter->locale = 'es-MX';

 if ($soap_response): ?>
			
			
		
				<table class="table table-bordered" id="datagrid" class="display compact" style="width:100%">
					<thead>
						<tr>
    						<th colspan="<?= count($columns = get_object_vars($soap_response[0])); ?>">#Total Articulos <?=count($soap_response)?></th>
						</tr>
						<tr>
							<?php foreach ($columns as $key => $val):?>
								<th><?=$key?></th>
							<?php endforeach;?>	
						</tr>
					</thead>
					<tbody>
						<?php foreach($soap_response as $articulo): ?>
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
             
             <?php foreach ($value as $val):?>
             			<tr>
            				<?php foreach (get_object_vars($val) as $data=>$dataValue): ?>
            				<td><b><?=$data?></b> </td>
            				<td><?=$dataValue?> </td>
            				<?php endforeach;?>			
  						</tr>  				
      		 <?php endforeach;?>					
			           	
            </table> 
            
          <?php endif;?>  
    
<?php }?>