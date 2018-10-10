<?php

use backend\models\constants\Constantes;
use backend\models\util\Util;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use backend\models\ArticuloComp;



?>
 <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,


                            'columns' => [

                                'sku',
                                'descripcion',
                                [
                                    'header'=>'<i class="fa fa-usd"></i>',
                                    'attribute'=>'precio',
                                    'class' => 'kartik\grid\EditableColumn',
                                    'refreshGrid' => true,
                                    'mergeHeader' => true,
                                    'content'=>function($data) use($dollar){
                                        return ($data->moneda === 'USD')?round($data->precio*$dollar,2) .' <i>USD('. $data->precio .')</i>' : $data->precio;
                                    },
                                ],

                                ['attribute'=>'existencia',
                                 'header'=>'<i class="fa fa-cubes"></i>',
                                    'class' => 'kartik\grid\EditableColumn',
                                    'refreshGrid' => true,
                                 'mergeHeader' => true,
                                 'content'=>function($data){
                                        return $data->existencia;
                                    }
                                ],
                                    [//PCH Precio
                                        'header'=>'<i class="fa fa-usd"></i>',
                                        'class' => 'kartik\grid\EditableColumn',
                                        'refreshGrid' => true,
                                        'mergeHeader' => true,
                                        'format'=>'raw',
                                       'value'=>function($data) use($pchItems){

                                            return isset($pchItems[$data->sku])?$pchItems[$data->sku]->precio .( $pchItems[$data->sku]->moneda ==='USD'? ' <i>'. $pchItems[$data->sku]->moneda .'</i>':'') :'';
                                        },
                                        'contentOptions' =>function($data) use($pchItems){

                                            if (!isset($pchItems[$data->sku]->precio))
                                                                return ['class'=>'danger'];
                                                                if ($data->precio*1 >  $pchItems[$data->sku]->precio*1)
                                                                    return ['class'=>'warning'];
                                                                    if ($data->precio*1 <  $pchItems[$data->sku]->precio*1)
                                                                        return ['class'=>'success'];
                                                                    },

                                        'headerOptions' => ['class'=>'bg-light-blue'],
                                        'editableOptions' =>function ($data) use($pchItems) {
                                            $pcUp=false;

                                            if( $pchItem = isset($pchItems[$data->sku]))
                                                if($pchItems[$data->sku]->precio*1 > $data->precio)
                                                       $pcUp=true;

                                            return  [
                                            'header' => 'Aplicar precio de pch a super tienda',
                                            //'id'=>function($data){return 'ps_price_' . $data->sku;},
                                            'name'=>'pch_precio',
                                            'size'=>'sm',
                                            'showAjaxErrors'=>true,
                                            'preHeader'=>'<i class="fa fa-edit"></i>',
                                            'format' => Editable::FORMAT_BUTTON,
                                            'value'=>$pchItem?$pchItems[$data->sku]->precio :'--',
                                            'options'=>['readonly'=>'true'],

                                            'editableButtonOptions'=>['class'=>$pcUp ? "btn btn-xs btn-success":"btn btn-xs btn-warning",
                                                'style'=>(!$pchItem || $pchItems[$data->sku]->precio*1 === $data->precio*1 )?"display: none;":"",
                                                'label'=>$pcUp? '<i class="fa fa-thumbs-o-up"></i>':'<i class="fa fa-thumbs-o-down"></i>'],

                                            'submitButton'=>['icon'=>'<i class="fa fa-download"></i>','label'=>'Aplicar cambio de pch']

                                            ]; },

                                        ],

                                        [//PCH existencia
                                            'class' => 'kartik\grid\EditableColumn',
                                            'header'=>'<i class="fa fa-cubes"></i>',
                                            'mergeHeader' => true,
                                            'format'=>'raw',
                                            'refreshGrid' => true,
                                            'readonly'=>function($data) use($pchItems){
                                                return !isset($pchItems[$data->sku]) || $pchItems[$data->sku]->inventario[0]->existencia*1 == $data->existencia;
                                            },
                                            'value'=>function($data) use($pchItems){
                                            return isset($pchItems[$data->sku]->inventario[0]->existencia)?$pchItems[$data->sku]->inventario[0]->existencia:'--';
                                            },
                                            'contentOptions' =>function($data) use($pchItems){

                                            if (!isset($pchItems[$data->sku]->inventario[0]->existencia))
                                                return ['class'=>'danger'];
                                                if ($data->existencia*1 <  $pchItems[$data->sku]->inventario[0]->existencia*1)
                                                    return ['class'=>'success'];
                                                    if ($data->existencia*1 >  $pchItems[$data->sku]->inventario[0]->existencia*1)
                                                        return ['class'=>'warning'];
                                            },
                                            'headerOptions' => ['class'=>'bg-light-blue'],
                                            'editableOptions' =>function($data) use($pchItems){ return [
                                                'preHeader'=>'<i class="fa fa-download"></i>',
                                                'header' => 'Importar cantidad a SuperTienda',
                                                'name'=>'pch_existencia',
                                                'value'=>isset($pchItems[$data->sku])?$pchItems[$data->sku]->inventario[0]->existencia :'--',
                                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                                'options' => [
                                                      'pluginOptions' => ['min' => 0, 'max' =>isset($pchItems[$data->sku]) ? $pchItems[$data->sku]->inventario[0]->existencia: 0,'verticalbuttons'=>true]
                                                ]
                                                ];
                                                },

                                            ],
                                [//PrestaShop establecer ganancia
                                    'header'=>'<i class="fa fa-mixcloud"></i><br /><i class="fa fa-usd"></i>',

                                    'class' => 'kartik\grid\EditableColumn',
                                    'refreshGrid' => true,
                                    'mergeHeader' => true,
                                    'value'=>function($data) use($dollar){
                                     return round(Util::getPSFinalprice($data->precio, $data->utilidad_ps, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$data->tipo_utilidad_ps),2);
                                    ;
                                    },


                                    'headerOptions' => ['class'=>'bg-purple'],
                                    'editableOptions' =>function($data) use($dollar){ return [
                                        'preHeader'=>'<i class="fa fa-edit"></i>',
                                        'header' => 'Establecer ganancia',
                                        'name'=>'ps_precio_util',
                                        'options'=>['readonly'=>'true'],
                                        'value'=>round(Util::getPSFinalprice($data->precio, $data->utilidad_ps, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$data->tipo_utilidad_ps),2),

                                        'afterInput' => function ($form, $widget) use($data) {

                                        $model = new ArticuloComp();
                                        $model->tipo_utilidad_ps = $data->tipo_utilidad_ps;
                                        $model->utilidad_ps = $data->utilidad_ps;

                                        return   $form->field($model, "tipo_utilidad_ps")->dropDownList(
                                                [1=>'Porcentaje (%)', 2=>'Monto ($)']


                                                )->label('Tipo de utilidad') .

                                                $form->field($model, "utilidad_ps")->textInput()->label('Utilidad');


                                        }
                                    ];
                                    },

                                  ],

                                  [//PrestaShop Publicar precio
                                      'header'=>'',

                                      'class' => 'kartik\grid\EditableColumn',
                                      'refreshGrid' => true,
                                      'mergeHeader' => true,
                                      'headerOptions' => ['class'=>'bg-purple',],
                                      'value'=>function ($data) use($psItems,$dollar){
                                        return ' ';
                                      },
                                      'contentOptions' =>function($data) use($psItems,$dollar){

                                      $psHubPrecio = round(Util::getPSFinalprice($data->precio, $data->utilidad_ps, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$data->tipo_utilidad_ps),2);


                                      if (!isset($psItems[$data->sku]))
                                          return ['class'=>''];
                                          if ($psHubPrecio < $psItems[$data->sku]['price']*1)
                                              return ['class'=>'warning'];
                                              if ($psHubPrecio >$psItems[$data->sku]['price']*1)
                                                  return ['class'=>'success'];
                                      },

                                      'editableOptions' =>function ($data) use($psItems,$dollar) {

                                      $psItem=isset($psItems[$data->sku]);
                                      $psHubPrecio = round(Util::getPSFinalprice($data->precio, $data->utilidad_ps, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$data->tipo_utilidad_ps),2);
                                      $psOnlPrecio  = $psItem ? round($psItems[$data->sku]['price'],2):0;


                                              return  [
                                                  'header' => 'Publicar precio a PrestaShop',
                                                  //'id'=>function($data){return 'ps_price_' . $data->sku;},
                                                  'name'=>'ps_public_precio',
                                                  'size'=>'sm',
                                                  'showAjaxErrors'=>true,
                                                  'preHeader'=>'<i class="fa fa-sellsy"></i>',
                                                  'format' => Editable::FORMAT_BUTTON,
                                                  'value'=>$psHubPrecio,
                                                  'options'=>['readonly'=>'true'],

                                                  'editableButtonOptions'=>['class'=>!$psItem ? 'btn btn-xs btn-primary':( $psHubPrecio*1>$psOnlPrecio*1 ? "btn btn-xs btn-success":"btn btn-xs btn-warning"),
                                                      'style'=>( $psHubPrecio*1 === $psOnlPrecio*1 )?"display: none;":"",
                                                      'label'=>!$psItem? '<i class="fa fa-send"></i>':(($psHubPrecio>$psOnlPrecio) ? '<i class="fa fa-thumbs-o-up"></i>': '<i class="fa fa-thumbs-o-down"></i>')],

                                                  'submitButton'=>['icon'=>'<i class="fa fa-sellsy"></i>','label'=>'Publicar en PrestaShop'],
                                                  'afterInput' => function ($form, $widget) use($data,$psItems,$psHubPrecio) {

                                                  $model = new ArticuloComp();
                                                  $model->idPs =isset($psItems[$data->sku]['id'])?$psItems[$data->sku]['id']:0;
                                                  $model->precioPs = $psHubPrecio;
                                                  $model->precioPsOriginal = isset($psItems[$data->sku]['price'])?$psItems[$data->sku]['price']:0;
                                                  $model->sku = $data->sku;
                                                  $model->descripcion = $data->descripcion;
                                                  $model->existencia_ps = $data->existencia_ps;

                                                  return   $form->field($model, "idPs")->hiddenInput()->label(false) .
                                                            $form->field($model, "precioPsOriginal")->hiddenInput()->label(false) .
                                                              $form->field($model, "precioPs")->hiddenInput()->label(false).
                                                                $form->field($model, "sku")->hiddenInput()->label(false).
                                                                  $form->field($model, "descripcion")->hiddenInput()->label(false).
                                                                    $form->field($model, "existencia_ps")->hiddenInput()->label(false);


                                                  }

                                              ]; },
                                  ]
                                      ,

                                  [//Prestashop onlie precio
                                      'header'=>'<i class="fa fa-sellsy"></i><br /><i class="fa fa-usd"></i>',
                                      'attribute'=>'utilidad_ps',
                                      'mergeHeader' => true,
                                      'content'=>function($data) use($psItems){
                                        return isset($psItems[$data->sku])?round($psItems[$data->sku]['price'],2):'--';
                                      },
                                      'contentOptions' =>function($data) use($psItems,$dollar){

                                      $psHubPrecio = round(Util::getPSFinalprice($data->precio, $data->utilidad_ps, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  ,$data->tipo_utilidad_ps),2);


                                      if (!isset($psItems[$data->sku]))
                                          return ['class'=>''];
                                          if ($psHubPrecio < $psItems[$data->sku]['price']*1)
                                              return ['class'=>'warning'];
                                              if ($psHubPrecio >$psItems[$data->sku]['price']*1)
                                                  return ['class'=>'success'];
                                      },
                                      'headerOptions' => ['class'=>'bg-purple'],

                                      ],

                                      [//PrestaShop cantidad hub
                                          'header'=>'<i class="fa fa-mixcloud"></i><br /><i class="fa fa-cubes"></i>',
                                          'class' => 'kartik\grid\EditableColumn',
                                          'refreshGrid' => true,
                                          'mergeHeader' => true,
                                          'value'=>function($data) {
                                          return $data->existencia_ps?$data->existencia_ps:'--';
                                          },
                                         // 'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                          'contentOptions' =>function($data) {


                                          if ($data->existencia*1 == $data->existencia_ps*1 )
                                              return ['class'=>''];
                                              if ($data->existencia*1 < $data->existencia_ps*1)
                                                  return ['class'=>'danger'];
                                                  if ($data->existencia*1 >$data->existencia_ps*1)
                                                      return ['class'=>'warning'];
                                          },
                                          'headerOptions' => ['class'=>'bg-purple'],
                                          'editableOptions'=>function ($data){
                                              return [
                                              'preHeader'=>'<i class="fa fa-edit"></i>',
                                              'header' => 'Establecer cantidad',
                                              'name'=>'existencia_ps',
                                              'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                              'options' => [
                                                  'pluginOptions' => ['min' => 0, 'max' =>$data->existencia,'initval'=>$data->existencia,'verticalbuttons' => true]
                                              ]
                                          ];},

                                          ],

                                          [//PrestaShop publicar Cantidad
                                              'header'=>'',
                                              'class' => 'kartik\grid\EditableColumn',
                                              'refreshGrid' => true,
                                              'mergeHeader' => true,
                                              'headerOptions' => ['class'=>'bg-purple',],
                                              'value'=>function ($data) use($psItems,$dollar){
                                              return ' ';
                                              },
                                              'readonly'=>function ($data) use($psItems,$dollar){return !isset($psItems[$data->sku]);},
                                              'contentOptions' =>function($data) use($psItems,$dollar){



                                              if (!isset($psItems[$data->sku]))
                                                  return ['class'=>''];
                                                  if ($data->existencia_ps*1 < $psItems[$data->sku]['quantity']*1)
                                                      return ['class'=>'warning'];
                                                      if ($data->existencia_ps*1 >$psItems[$data->sku]['quantity']*1)
                                                          return ['class'=>'success'];
                                              },

                                              'editableOptions' =>function ($data) use($psItems,$dollar,$pchItems) {

                                              $psItem=isset($psItems[$data->sku]);


                                              return  [
                                                  'header' => 'Publicar cantidad a PrestaShop',
                                                  //'id'=>function($data){return 'ps_price_' . $data->sku;},
                                                  'name'=>'ps_publicar_cantidad',
                                                  'size'=>'xs',
                                                  'showAjaxErrors'=>true,
                                                  'preHeader'=>'<i class="fa fa-sellsy"></i>',
                                                  'format' => Editable::FORMAT_BUTTON,
                                                  'value'=>$data->existencia_ps,
                                                  'options'=>['readonly'=>'true'],

                                                  'editableButtonOptions'=>['class'=>!$psItem ? 'btn btn-xs btn-primary':( $data->existencia_ps*1>$psItems[$data->sku]['quantity']*1 ? "btn btn-xs btn-success":"btn btn-xs btn-warning"),
                                                      'style'=>(isset($psItems[$data->sku]) && $data->existencia_ps*1 == $psItems[$data->sku]['quantity']*1)?"display: none;":"",
                                                      'label'=>!$psItem? '':(($data->existencia_ps*1>$psItems[$data->sku]['quantity']*1) ? '<i class="fa fa-thumbs-o-up"></i>': '<i class="fa fa-thumbs-o-down"></i>')],

                                                  'submitButton'=>['icon'=>'<i class="fa fa-sellsy"></i>','label'=>'Publicar en PrestaShop'],
                                                  'afterInput' => function ($form, $widget) use($data,$psItems) {

                                                  $model = new ArticuloComp();
                                                  $model->existencia_ps = $data->existencia_ps;
                                                  $model->idPs = isset($psItems[$data->sku]['id'])?$psItems[$data->sku]['id']:0;

                                                  return   $form->field($model, "existencia_ps")->hiddenInput()->label(false).
                                                  $form->field($model, "idPs")->hiddenInput()->label(false);



                                                  }

                                              ]; },
                                              ],





                                      [//Prestashop importar cantidad a hub
                                          'header'=>'<i class="fa fa-sellsy"></i><br /><i class="fa fa-cubes"></i>',
                                          'mergeHeader' => true,
                                          'class' => 'kartik\grid\EditableColumn',

                                          'refreshGrid' => true,
                                          'value'=>function($data) use($psItems){
                                            return isset($psItems[$data->sku])?$psItems[$data->sku]['quantity']:'--';
                                          },
                                          //'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                          'readonly'=>function($data) use($psItems){return !isset($psItems[$data->sku]) || $psItems[$data->sku]['quantity']*1 == $data->existencia_ps;},
                                          'headerOptions' => ['class'=>'bg-purple'],

                                          'contentOptions' =>function($data) use($psItems){
                                              if (!isset($psItems[$data->sku]))
                                                  return ['class'=>''];
                                                  if ($data->existencia_ps*1 < $psItems[$data->sku]['quantity']*1)
                                                      return ['class'=>'warning'];
                                                      if ($data->existencia_ps*1 >$psItems[$data->sku]['quantity']*1)
                                                          return ['class'=>'success'];
                                              },

                                              'editableOptions' =>function($data) use($psItems){ return [
                                                  'preHeader'=>'<i class="fa fa-donwload"></i>',
                                                  'header' => 'Importar cantidad Prestashop a SuperTienda',
                                                  'name'=>'ps_importar_cantidad_hub',
                                                  'preHeader'=>'<i class="fa fa-download"></i>',
                                                  'options'=>['readonly'=>'true'],
                                                  'value'=>isset($psItems[$data->sku])?$psItems[$data->sku]['quantity']:0,
                                                  'afterInput' => function ($form, $widget) use($data,$psItems) {
                                                  $model = new ArticuloComp();
                                                  $model->actualizaCantidadPs = false;
                                                  $model->sku = $data->sku;
                                                  $model->existencia_ps = isset($psItems[$data->sku])?$psItems[$data->sku]['quantity']:0;


                                                  return   $form->field($model, "actualizaCantidadPs")->checkbox().
                                                  $form->field($model, "sku")->hiddenInput()->label(false).
                                                    $form->field($model, "existencia_ps")->hiddenInput()->label(false);


                                                  }
                                                  ];
                                              },


                                        ],


                                        [
                                            'header'=>'<i class="fa fa-mixcloud"></i><br /><i class="fa fa-usd"></i>',
                                            'attribute'=>'utilidad_ml',
                                            'mergeHeader' => true,
                                            'content'=>function($data) use ($dollar){
                                            return round(Util::getMLFinalprice($data->precio, $data->utilidad_ml, $dollar, ($data->moneda == 'USD')?Constantes::CURRENCY_US:Constantes::CURRENCY_MX  , $data->tipo_utilidad_ml, $data->comision_ml),2);;
                                            },
                                            'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                            'headerOptions' => ['class'=>'bg-yellow'],

                                            ],

                                            [
                                                'header'=>'<i class="fa fa-truck"></i><br /><i class="fa fa-usd"></i>',
                                                'attribute'=>'utilidad_ps',
                                                'mergeHeader' => true,
                                                'content'=>function($data) use($psItems){
                                                return isset($psItems[$data->sku])?round($psItems[$data->sku]['price'],2):'--';
                                                },
                                                'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                'headerOptions' => ['class'=>'bg-yellow'],

                                                ],

                                                [
                                                    'header'=>'<i class="fa fa-mixcloud"></i><br /><i class="fa fa-cubes"></i>',
                                                    'attribute'=>'existencia_ml',
                                                    'content'=>function($data) {
                                                        return $data->existencia_ml;
                                                    },
                                                    'mergeHeader' => true,
                                                    'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                    'headerOptions' => ['class'=>'bg-yellow'],

                                                    ],

                                                    [
                                                        'header'=>'<i class="fa fa-truck"></i><br /><i class="fa fa-cubes"></i>',
                                                        'attribute'=>'existencia_ps',
                                                        'mergeHeader' => true,
                                                        'content'=>function($data) use($psItems){
                                                        return isset($psItems[$data->sku])?$psItems[$data->sku]['quantity']:'--';
                                                        },
                                                        'contentOptions' =>['style' => 'border: 1px solid #FF95C5'],
                                                        'headerOptions' => ['style' => 'border: 1px solid #FF95C5','class'=>'bg-yellow'],

                                                        ],



                              //  [   'class' => 'yii\grid\ActionColumn',
                                //    'options' => ['class' => 'skip-export']
                              //  ],

                            ],
                            'toolbar' => [
                                ['content' =>
                                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['site/dashboard'], ['class' => 'btn btn-default', 'title' => 'Reiniciar grid'])
                                ],
                                '{export}',
                                '{toggleData}'
                            ],


                            'beforeHeader' => [
                                [
                                    'columns' => [
                                        ['content' => '<i class="fa fa-mixcloud"></i> Super tienda', 'options' => ['colspan' => 4, 'class' => 'text-center' , ]],
                                        ['content' => '<i class="fa fa-cart-arrow-down"></i> PCH', 'options' => ['colspan' => 2, 'class' => 'bg-light-blue text-center',]],
                                        ['content' => '<i class="fa fa-sellsy"></i> PrestaShop', 'options' => ['colspan' => 6, 'class' => 'bg-purple text-center']],
                                        ['content' => '<i class="fa fa fa-truck"></i> Mercado Libre', 'options' => ['colspan' => 4, 'class' => 'bg-yellow text-center']],
                                    ],
                                    //  'options'=>['class'=>'skip-export'] // remove this row from export
                                ]
                            ],


                            'pjax' => true,
                            'bordered' => true,
                            'striped' => false,
                            'condensed' => true,
                            'responsive' => true,
                            'hover' => true,

                            'floatHeader' => true,
                            'floatHeaderOptions' => ['scrollingTop' => true],
                            'panel' => [
                                'type' => GridView::TYPE_ACTIVE
                            ],
                            'pjaxSettings'=>[
                                'neverTimeout'=>'true'
                            ]
                        ]);
