<?php

/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 22/06/2018
 * Time: 12:37 PM
 */

/* @var $model common\models\TimelineEvent */

?>

<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header">
        <i class="fa fa-cart-arrow-down"></i> Se han actualizado los precios en Mercado Libre
    </h3>

    <div class="timeline-body">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                    </div>
                </div>
            </div>
    </div>

    <div class="timeline-footer">
        <?php echo \yii\helpers\Html::a(
            '<i class="fa fa-eye"></i>&nbsp; Consultar',
            ['/articulo-meli/index'],
            ['class' => 'btn btn-warning btn-sm']
        ) ?>
    </div>
</div>


