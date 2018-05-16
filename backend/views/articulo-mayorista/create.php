<?php

use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model backend\models\ArticuloMayorista */

$this->title = 'Create Articulo Mayorista';
$this->params['breadcrumbs'][] = ['label' => 'Articulo Mayoristas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$this->registerCssFile("/css/jquery.dataTables.min.css", [
    'position' => View::POS_HEAD,
    'media' => 'print',
], 'css-print-theme');




$this->registerJsFile(
    '/js/jquery.dataTables.min.js'
   
    );

$this->registerJs(
"
    $('#example').DataTable();
",
    View::POS_READY,
    'my-button-handler'
    );

?>
<div class="articulo-mayorista-create">

    <?php echo $this->render('_fkorm', [
        'model' => $model,
    ]) ?>

</div>
