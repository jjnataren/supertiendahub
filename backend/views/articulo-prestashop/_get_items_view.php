<?php
use common\models\KeyStorageItem;
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
														<th></th>
                            						</tr>
                            					</thead>
                            					<tbody>
                            						<?php

                            						$apiUrl = Yii::$app->getSecurity()->decryptByKey(base64_decode(KeyStorageItem::findOne('config.prestashop.client.url.api')->value), env('SECRET_KEY'));

                            						foreach($items as $articulo): ?>
                            						<tr>
                            						    <?php //TODO: take advantage of yii2 array helper?>
                            							<td><?=isset($articulo['id'])?$articulo['id']:''?></td>
                            							<td><?=(isset($articulo['reference']) && !is_array($articulo['reference']) ) ?$articulo['reference']:''?></td>
                            							<td><?=isset($articulo['name']['language'][0])?$articulo['name']['language'][0]:''?></td>
                            							<td><?=isset($articulo['price'])?$articulo['price']:''?></td>
                            							<td><?=isset($articulo['quantity'])?$articulo['quantity']:''?></td>
														<td><a href="<?=$apiUrl?>/index.php?id_product=<?=isset($articulo['id'])?$articulo['id']:''?>&controller=product" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-plane"></i> Consultar</a></td>
                            						</tr>
                            					<?php endforeach;?>
                            					</tbody>
                            				</table>


<?php endif;?>