<?php

use backend\models\ArticuloMayorista;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @var $model common\models\TimelineEvent
 */
?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header">
       <i class="fa fa-cart-arrow-down"></i> PHC Mayorista ha cambiado articulos
    </h3>

    <div class="timeline-body">
    
    
    	<?php if($articles = isset( $model->data['articles'] ) ?$model->data['articles'] : false ){
    	    
    	    foreach($articles as $key=>$item){
    	        
    	                       $dbmodel = new ArticuloMayorista();
    	                       $dbmodel->attributes = $item['dbmodel'];
    	                       
    	                       $model = new ArticuloMayorista();
    	                       $model->attributes = $item['model'];
    	                       
						    
						        $changes[] = ($art_status =  !isset($dbmodel) ? 'info' : ( ($dbmodel->precio*1 < $model->precio*1) ?'success':'warning' )); 
						} 
    				
    	?>			
       
			  <div class="col-md-12"> 
				      <div class="panel panel-default">
				      <div class="panel-body">
				      <?php $vals = array_count_values($changes);?>
				      
				      
				      <table class="table table-condensed"> 
                      
                      <tbody>
                      <tr>
                      <td>
                      <p> 		 
                       		  <span class="label label-info">
                               <?=isset($vals['info'])?$vals['info']:'0'?>            
                             </span> &nbsp; &nbsp;
                       		<i class="fa fa-opencart"></i> Nuevos   
					
						</p>
						</td>
						<td>
						<p> 		 
                       		  <span class="label label-success">
                               <?=isset($vals['success'])?$vals['success']:0?>            
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-up"></i> Subieron de precio   
					
						</p>
						</td>
						<td>
						<p> 		 
                       		  <span class="label label-warning">
                               <?=isset($vals['warning'])?$vals['warning']:0?>             
                             </span> &nbsp; &nbsp;
                       			<i class="fa fa-level-down"></i> Bajaron de precio   
					
						</p>
						</td>
						</tbody>
						</tbody>
						</table>
						</div>
						</div>
						</div>       
       
       
       <?php }?>
    </div>

    <div class="timeline-footer">
      <?php echo \yii\helpers\Html::a(
            '<i class="fa fa-eye"></i>&nbsp; Consultar',
            ['/articulo-mayorista/index'],
            ['class' => 'btn btn-warning btn-sm']
        ) ?>
    </div>
</div>