<?php

use yii\widgets\DetailView;
use backend\models\Articulo;

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
       <i class="fa fa-cart-arrow-down"></i> Se ha actualizado un articulo
    </h3>

    <div class="timeline-body">


    	<?php if($modelArticulo = isset( $model->data['model'] ) ?$model->data['model'] : false ):?>



	<div class="col-md-6">
	<h3>Producto actualizado</h3>
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
	</div>
    <div class="col-md-6">
	<h3>Producto antes de actualizar</h3>
		<?php echo DetailView::widget([
		    'model' => $model->data['old_model'] ,
            'attributes' => [
            'sku',
            'marca',
            'serie',
            'precio',
                'existencia'
        ],
    ]) ?>

	</div>
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