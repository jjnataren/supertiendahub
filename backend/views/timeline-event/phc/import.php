<?php

use yii\widgets\DetailView;

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
       <i class="fa fa-cart-arrow-down"></i> Se ha importado un nuevo producto
    </h3>

    <div class="timeline-body">


    	<?php if($modelArticulo = isset( $model->data['model'] ) ?$model->data['model'] : false ):?>




	<h3>Producto Importado</h3>
		<?php echo DetailView::widget([
		    'model' =>$model->data['model'] ,
        'attributes' => [
            'sku',
            'marca',
            'serie',
            'precio',
            'existencia'
        ],
    ]) ?>


       <?php endif;?>

    </div>

    <div class="timeline-footer">
      <?php echo \yii\helpers\Html::a(
            '<i class="fa fa-cog"></i>&nbsp; Administrar',
            ['/articulo/index'],
            ['class' => 'btn btn-warning btn-sm']
        ) ?>
    </div>
</div>