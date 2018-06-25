<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayoristaSnap */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'PHC Mayoristas', 'url' => ['articulo-mayorista/index']];
$this->params['breadcrumbs'][] = ['label' => 'Imagen <i class="fa fa-camera" ></i>  ' . $model->nombre];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">

 <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Imagen  tomada a los precios publicados en PHC Mayoristas</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          
              <div class="col-md-3">
				
              <dl>
              
             
                <dt><i class="fa fa-camera"></i> Imagen </dt>
               <dd><?= $model->nombre;?></dd>
                
                <dt><i class="fa fa-calenar"></i>  Fecha en que se tomo</dt>
                <dd><?= Yii::$app->formatter->asDate($model->fecha_creacion,'dd/MMM/Y'); ?></dd>
                
               <dt><i class="fa fa-th"></i> Numero de registros</dt>
              
                <dd>2104</dd>
                <dt> ¿Imagen actual?</dt>
              
                <dd>SI</dd>
    
              </dl>
             </div> 
             </div> 
             
              <div class="box-footer">
       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Buscar cambios', ['#'], ['class' => 'btn btn-primary','id'=>'soaprequest']) ?>
            </div>
            </div>
           
            <!-- /.box-body -->
          </div>
          
          
          
               <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Listado de articulos en la imagen</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['#', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['#'], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Confirmar eliminar?',
                        'method' => 'post',
                    ],
                ]) ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="phcMayoristaArt">
			
				<?php
 if ($soap_response = json_encode($model->data)): ?>
			
			
		
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
		
   			 </div>
    
     <div class="box-footer">
       			 
     </div>
    
    </div>
    </div>

</div>

<div class="articulo-mayorista-snap-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha_creacion',
            'nombre',
            'descripcion',
            'data:ntext',
            'disponible',
        ],
    ]) ?>

</div>
