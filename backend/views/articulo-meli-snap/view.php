<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMeliSnap */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mercado Libre Snaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-meli-snap-view">

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Realmente desea eliminar el Snapshot?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha_creacion',
                'nombre',
                'descripcion',
                'data:ntext',
                'disponible',
                'actual',
                'numero_registros',
            ],
        ]);
    } catch (Exception $e) {
        echo 'No se pudo mostrar el detalle.';
    } ?>

</div>
