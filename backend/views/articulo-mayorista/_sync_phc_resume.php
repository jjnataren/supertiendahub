<?php
if ($articles): ?>
			
			
				<p class="text text-success">
    						Numero de total de Cambios encontrados <?=count($articles)?>
						</p>
			
		
				<table class="table table-bordered" id="comparegrid" class="display compact" style="width:100%">
					<thead>
						<tr>
							
								<th>sku</th>
								<th>Nombre</th>
								<th colspan="2">Precion PHC Imagen actual guardada</th>
								<th colspan ="2">Precio PHC Servicio en linea</th>
								
						</tr>
					</thead>
					<tbody>
						<?php foreach($articles as $key=>$item): ?>
    						<tr class="<?= !isset($item['dbmodel']->precio)?'info':($item['dbmodel']->precio<$item['model']->precio)?'success':'warning'  ?>" >
    						     <td><?= $key ?></td>
    						     <td><?= isset($item['model']->seccion)?$item['model']->seccion:'' ?></td>
    						     <td><?= isset($item['dbmodel']->precio)?$item['dbmodel']->precio:'<b>Articulo nuevo</b>' ?></td>
    						     <td></td>
    						     <td><?= isset($item['model']->precio)?$item['model']->precio:''?></td>
    						     <td></td>
    						</tr>	
						<?php endforeach;?>
					</tbody>
				</table>
		
				
 <?php endif;?>
 
 
 
 
