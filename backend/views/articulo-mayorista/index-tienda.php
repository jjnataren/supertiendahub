<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi tienda';
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'es-MX';
?>
<div class="row">


 <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Información de mi tienda</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => 1], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => 'Si elimina este curso base se perdera todo el historial de los cursos impartidos y por impartir?',
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
              
             
                <dt>Nombre del mi tienda </dt>
               <dd>Super tienda</dd>
                
                <dt>Direccion</dt>
                <dd>Ciudad de Mexico</dd>
               <dt><i class="fa fa-black-tie"></i> Responsable</dt>
              
                <dd>Jhon doe</dd>
    
              </dl>
             </div> 
              <div class="col-md-3">
            
              <dl>
               <dt><i class="fa fa-truck"></i> Mercado Libre</dt>
               <dd>Actualizada y sincronizada</dd>
               <dt>Cuenta</dt>
               <dd><a href="#">super_tienda</a></dd>
              
               <dt>Ultima actualizacion</dt>
               <dd><?=date("Y-m-d")?></dd>
               <dt>Revisar cambios</dt>
               <dd><a href="#">Ir</a></dd>
               
              </dl>
             </div> 
              <div class="col-md-3">
           <dl>
               <dt><i class="fa fa-sellsy"></i> PrestaShop</dt>
               <dd>Actualizada y sincronizada</dd>
               <dt>Cuenta</dt>
               <dd><a href="#">supertienda.com.mx</a></dd>
              
               <dt>Ultima actualizacion</dt>
               <dd><?=date("Y-m-d")?></dd>
               <dt>Revisar cambios</dt>
               <dd><a href="#">Ir</a></dd>
               
              </dl>
             </div> 
             
               <div class="col-md-3">
           <dl>
               <dt><i class="fa fa-amazon"></i> Amazon</dt>
               <dd>Actualizada y sincronizada</dd>
               <dt>Cuenta</dt>
               <dd><a href="#">supertienda.com.mx</a></dd>
              
               <dt>Ultima actualizacion</dt>
               <dd><?=date("Y-m-d")?></dd>
               <dt>Revisar cambios</dt>
               <dd><a href="#">Ir</a></dd>
               
              </dl>
             </div> 
             
             </div> 
             
              <div class="box-footer">
       			 <?php echo Html::a('<i class="fa fa-refresh"></i> Buscar cambios', ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
            </div>
           
            <!-- /.box-body -->
          </div>




    
    
    
     <div class="col-md-12">
               <div class="box box-info with-border">
            <div class="box-header with-border">
            	<i class="fa fa-th"></i>
              <h3 class="box-title">Articulos en Datawarehouse</h3>

              <div class="box-tools pull-right">
              <?php echo Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => 1], ['class' => 'btn']) ?>
              <?php echo Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => 1], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => 'Si elimina este curso base se perdera todo el historial de los cursos impartidos y por impartir?',
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

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        
        'columns' => [

            'sku',
            'marca',
            'serie',
            'existencia',
            [
                'attribute'=>'disponible',
                
                'content'=>function($data){
                
                return  ($data->disponible)?'SI':'Opcional';
                
                },
                'filter'=>[0=>'No',1=>'Si'],
                ],
                
            
            

            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class'=>'skip-export']
            ],
            
        ],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="fa fa-plus"></i>', ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>'Nueva']).
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}'
        ],
        
      
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Categorías de talleres', 'options'=>['colspan'=>3, 'class'=>'text text-left']],
                    ['content'=>Yii::$app->formatter->asDate(date('Y-m-d')), 'options'=>['colspan'=>2, 'class'=>'text-center']],
                ],
              //  'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        
        
        
        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => true],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
    
    </div>
    </div>
    </div>
    

</div>
