<?php




Yii::$app->formatter->locale = 'es-MX';

if ($items): ?>
			
			
		
				<table class="table table-bordered table-responsive" style="width: 100%" id="ps_data_grid" >
					<thead>
						<tr>
    						<th colspan="5">#Total Articulos <?=count($items)?></th>
						</tr>
						<tr>
							
							<th>id</th>
							<th>reference</th>
							<th>name</th>
							<th>price</th>
							<th>quantity</th>
					
						</tr>
					</thead>
					<tbody>
						<?php foreach($items as $articulo): ?>
						<tr>
						    <?php //TODO: take advantage of yii2 array helper?>
							<td><?=isset($articulo['id'])?$articulo['id']:''?></td>
							<td><?=(isset($articulo['reference']) && !is_array($articulo['reference']) ) ?$articulo['reference']:''?></td>
							<td><?=isset($articulo['name']['language'][0])?$articulo['name']['language'][0]:''?></td>
							<td><?=isset($articulo['price'])?$articulo['price']:''?></td>
							<td><?=isset($articulo['quantity'])?$articulo['quantity']:''?></td>
					
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