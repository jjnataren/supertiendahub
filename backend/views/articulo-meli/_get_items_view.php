<?php



Yii::$app->formatter->locale = 'es-MX';

if ($items): ?>



				<table class="table table-bordered" id="ml_data_grid" class="display compact" style="width:100%">
					<thead>
						<tr>
    						<th colspan="9">#Total Articulos <?=count($items)?></th>
						</tr>
						<tr>

							<th>Id</th>
							<th>seller_custom_field</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Existencias</th>
							<th>Estatus</th>
							<th>Última actualización</th>
							<th>Imagen</th>


							<th></th>

						</tr>
					</thead>
					<tbody>
						<?php foreach($items as $articulo): ?>
						<tr>

							<td><?=isset($articulo['id'])?$articulo['id']:''?></td>
							<td><?=isset($articulo['seller_custom_field'])?$articulo['seller_custom_field']:''?></td>
							<td><?=isset($articulo['title'])?$articulo['title']:''?></td>
							<td><?=isset($articulo['price'])?Yii::$app->formatter->asCurrency ($articulo['price']):''?></td>
							<td><?=isset($articulo['available_quantity'])?$articulo['available_quantity']:''?></td>
							<td><?=isset($articulo['status'])?$articulo['status']:''?></td>
							<td><?=isset($articulo['last_updated'])?Yii::$app->formatter->asDatetime( $articulo['last_updated']):''?></td>
							<td><img src="<?=isset($articulo['thumbnail'])?$articulo['thumbnail']:''?>" ></img></td>
							<td><a class="btn btn-info" target="_blank" href="<?=isset($articulo['permalink'])?$articulo['permalink']:''?>" ><i class="fa fa-arrow-circle-right"></i> Consultar</a></td>

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