<?php 

use yii\web\View;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;
use richardfan\widget\JSRegister;
use yii\web\JsExpression;
use yii\helpers\Html;


$this->title = '  SUPER TIENDA HUB';

$this->registerJs("$('#help1').popover('hide');", View::POS_END, 'my-options1');
$this->registerJs("$('#help2').popover('hide');", View::POS_END, 'my-options2');

Yii::$app->formatter->locale = 'es-MX';


$this->params['subtitle'] = '';

$this->params['titleIcon'] = '
  								<i class="fa fa-mixcloud fa-2x"></i>
							  ';
$this->registerJs("$('#dataTable1').dataTable( {'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json' }});", View::POS_END, 'my-options');


?>
				<!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                      <i class="fa fa-money"></i>
                                       $19.92
                                    </h3>
                                    <p>
                                                                     
                                       Paridad dolar PHC mayoristas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_comision">
                                  Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3>
                                      <i class="glyphicon glyphicon-calendar"></i>
                                               10
                                    </h3>
                                    <p>
                                        Cambios en articulos PHC
                                        
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_plan">
                                 Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                    <i class="fa  fa-truck"></i>
                                    5
                                    </h3>
                                    <p>
                                        Cambios en Mercado Libre
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_constancia1">
                                   Ir  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                         <div class="col-md-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3> <i class="fa fa-sellsy"></i>  7 </h3>
                                    <p>Cambios en PrestaShop</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a class="small-box-footer" href="#anchor_constancia1">
                                   Ir <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    
          <h4 class="page-header" id="anchor_comision">
         Articulos de SUPER TIENDA <small>almacenados en base de datos.</small> 
          
                       
          </h4>          
                    
               <div class="row">
               
               
                    
                <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Custom Tabs (Pulled to the right) -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                              		<?php $i=1;?>      
                              
                              
                              		<li><a data-toggle="tab" href="#tab_sync">SUPER TIENDA - PHC</a></li>
                                    <li class="active"><a data-toggle="tab" href="#tab_super_tienda">SUPER TIENDA</a></li>
                                    
                                  
                                    <li class="pull-left header"><i class="fa fa-mixcloud"></i> SUPER TIENDA HUB</li>
                                </ul>
                                <div class="tab-content">
                                  
                                    <div id="tab_super_tienda" class="tab-pane active">
                                        
                                      

                                            <?php echo GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                
                                                
                                                'columns' => [
                                        
                                                    'sku',
                                                    'descripcion',
                                                    [
                                                        'attribute'=>'precio',
                                                        'content'=>function($data){
                                                            return   Yii::$app->formatter->asCurrency($data->precio);
                                                        }
                                                        ],
                                                    
                                                    'marca',
                                                        
                                                    
                                                    
                                        
                                                    ['class' => 'yii\grid\ActionColumn',
                                                        'options'=>['class'=>'skip-export']
                                                    ],
                                                    
                                                ],
                                                'toolbar' =>  [
                                                    ['content'=>
                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [ 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                                                    ],
                                                    '{export}',
                                                    '{toggleData}'
                                                ],
                                                
                                              
                                                'beforeHeader'=>[
                                                    [
                                                        'columns'=>[
                                                            ['content'=>'Precios de la ultima imagen tomada', 'options'=>['colspan'=>3, 'class'=>'text text-left']],
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
                                            
                                    
                                    <p class="text-right">
                                    <button id="help1" tabindex="0" type="button" class="btn" data-toggle="popover" title="Ayuda" data-content="Articulos guardados e base de datos"><i class="fa fa-question-circle"></i>
						             </button>
                                    <?= Html::a('<i class="fa fa-cogs"></i> Administrar', ['comision-mixta-cap/dashboard','id'=>1], ['class' => 'btn btn-info btn-flat btn-sm']) ?>
                                    </p>   
                                     </div><!-- /.tab-pane -->
                                     
                                <div id="tab_sync" class="tab-pane">
								
    								<div class="row">
    								<div class="col-md-12">
    								<div class="panel">	
    									<div class="panel-body">
    									<div  id="phcMayoristaSync">
    			
    										<img src="/img/loading.gif" /> <p class="text text-info">Consultando servicio PHC Mayorista ....</p>
    		
       			 						</div>
    									</div>
    									<div class="panel-footer">
    										<?php echo Html::a('<i class="fa fa-refresh"></i> Actualizar', ['#'], ['class' => 'btn btn-primary','id'=>'syncrequest']) ?>
           								</div>
           							</div>
           							</div>
    								</div>
    									                                
                            	 </div>
                                     
                                   </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div>
                        
                        
                        
                     <div class="col-md-6 col-xs-12 col-sm-12">
                            <!-- AREA CHART -->
                            <div class="box box-primary">
                                <div class="box-header">
                                   <i class="glyphicon glyphicon-copyright-mark"></i>
                                    <h3 class="box-title">Comparativa de las comisiones en la organización</h3>
                                     <div class="box-tools pull-right">
            <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs" data-original-title="Remove"><i class="fa fa-times"></i></button>
          </div>
                                </div>
                                <div class="box-body">
                                <?php 
                                
                                $categories =['test','test2'];
                                $establecimientos =[2,6];
                                $integrantes = [30,10];
                                
                             
                                
                              echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Comisiones dentro de la organización',
        ],
        'xAxis' => [
            'categories' =>$categories,
        ],
        
        'series' => [
           
            [
                'type' => 'column',
                'name' => 'No. establecimientos',
                'data' => $establecimientos
            ],
            [
                'type' => 'column',
                'name' => 'No. integrantes',
                'data' => $integrantes
            ],
            [
                'type' => 'spline',
                'name' => 'Promedio establecimientos',
                'data' => $establecimientos,
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],
				[
				'type' => 'spline',
				'name' => 'Promedio integrantes',
				'data' => $integrantes,
				'marker' => [
				'lineWidth' => 2,
				'lineColor' => new JsExpression('Highcharts.getOptions().colors[2]'),
				'fillColor' => 'white',
				],
				],
           
        ],
    ]
]);
                                   ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                 

                        </div>
                    </div>
                    
  <h4 class="page-header" id="anchor_plan">
        Planes y programas <small>de capacitación, adiestramiento y productividad</small> 
   </h4>                     
                    
               
                    
 <h4 class="page-header" id="anchor_constancia">
          Constancias 
   		<small>Constancias emitidas a los trabajadores</small>
   </h4>     
    
                    
                  
                        
  
                        
                 

                
    <h4 class="page-header">
          Soporte y Ayuda
                        <small>Contenido de ayuda</small>
    </h4>    
                

                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Información util de la STPS </h3>
                                     <div class="box-tools pull-right">
            <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs" data-original-title="Remove"><i class="fa fa-times"></i></button>
          </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div id="accordion" class="box-group">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div class="panel box box-primary">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                                                                                                   
                                                      <b> DC-1 Comisiones Mixtas de Capacitación, Adiestramiento y Productividad</b>
                                                  
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse in" id="collapseOne">
                                                <div class="box-body">
 <h4>Artículo 7. Las Comisiones Mixtas de Capacitación, Adiestramiento y Productividad deberán constituirse en cada empresa que cuente con más de 50 trabajadores, e integrarse de manera bipartita y paritaria, por igual número de representantes de los trabajadores y del patrón.</h4>
                                                <h4>Las Comisiones Mixtas de Capacitación, Adiestramiento y Productividad, deberán realizar las siguientes funciones:</h4>
                                                <br>
                                                <h4><br>I.	Vigilar, instrumentar, operar y mejorar los sistemas y los programas de capacitación y adiestramiento;
                                                    <br>II.	Proponer los cambios necesarios en la maquinaria, los equipos, la organización del trabajo y las relaciones laborales, de conformidad con las mejores prácticas tecnológicas y organizativas que incrementen la productividad en función de su grado de desarrollo actual;
                                                    <br>III.	Proponer las medidas acordadas, con el propósito de impulsar la capacitación, medir y elevar la productividad, así como garantizar el reparto equitativo de sus beneficios;
                                                   <br> IV.	Vigilar el cumplimiento de los acuerdos de productividad;
                                                  <br>  V.	Resolver las objeciones que, en su caso, presenten los trabajadores con motivo de la distribución de los beneficios de la productividad;
                                                                                                 		                         
                                                
                                                </h4>                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel box box-info">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse">
                                                      <b> DC-2 Planes y Programas de Capacitación, Adiestramiento y Productividad</b>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse" id="collapseTwo">
                                                <div class="box-body">
                                                <h4><br>Artículo 9. Los planes y programas de capacitación se elaborarán mediante el formato DC-2 “Elaboración del plan y programas de capacitación, adiestramiento y productividad”, según el modelo anexo, dentro de los sesenta días hábiles siguientes al inicio de operaciones en el centro de trabajo
                                                
                                                <br>Artículo 10. Para la elaboración de los planes y programas se deberá:
<br>I.	Tomar en cuenta las necesidades de capacitación y adiestramiento de todos los puestos y niveles de trabajo existentes en la empresa;
<br>II.	Precisar el número de etapas durante las cuales se impartirán;
<br>III.	Indicar si se trata de planes y programas de capacitación y adiestramiento específicos para una empresa; comunes para varias empresas o bien si se encuentran adheridos a un sistema general de capacitación y adiestramiento por rama o actividad; y, en su caso, los establecimientos en los que  se aplica;
<br>IV.	Establecer periodos no mayores de dos años;	
<br>V.	Considerar la impartición de la capacitación o adiestramiento por conducto del personal de la propia empresa, instructores especialmente contratados, instituciones, escuelas u organismos especializados;
                                                
                                                                                                    
                                                </h4>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                                 <div class="panel box box-info">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse">
                                                      <b> DC-3 Agentes Capacitadores Externos</b>
                                                    </a>
                                                    
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse" id="collapseThree">
                                                <div class="box-body">
                                                <h4>
                                                
                                                <br>
                                                Artículo 16. Los Agentes Capacitadores Externos deberán solicitar su autorización y registro ante la Secretaría, así como el registro de los programas y cursos de capacitación que deseen impartir de conformidad con lo siguiente:
                                             
                                                <br>I.	Cuando se trate de instituciones, escuelas u organismos especializados de capacitación deberán presentar el Formato DC-5 “Solicitud de Registro de Agente Capacitador Externo”, según modelo anexo y acompañar la siguiente documentación:
                                                <br> II.	Cuando se trate de instructores independientes, deberán presentar el formato DC-5 “Solicitud de Registro de Agente Capacitador Externo”, según modelo anexo y la siguiente documentación:
                                                <br>Artículo 17. Cuando se hayan presentado de forma personal los documentos correspondientes, la Secretaría entregará de forma inmediata el acuse de recibo correspondiente.
Si la solicitud se presentó por correo certificado o servicios de mensajería, el acuse de recibo será enviado al solicitante el día hábil siguiente a la fecha de recepción de la solicitud, devolviendo la documentación original que hubiese acompañado, de conformidad con lo establecido en el artículo 27, segundo párrafo del presente Acuerdo.
                                               
                                                </h4>
                                              <br>   
                                                </div>
                                            </div>
                                        </div>
                                                                                                                        
                                        <div class="panel box box-info">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a href="#collapseFour" data-parent="#accordion" data-toggle="collapse">
                                                       <b> DC-4 Listas de Constancias de Competencias o de Habilidades Laborales</b>
                                                    </a>
                                                    
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse" id="collapseFour">
                                                <div class="box-body">
                                                
                                                
                                                <br>
                                            


Artículo 24. La constancia de competencias o de habilidades laborales deberá:<br>

<br><b>I.	Expedirse por:<br></b>

     <br>a.	La entidad instructora cuando se trate de agentes capacitadores externos;<br>

     <br>b.	Por la empresa, cuando se trate de instructores internos;<br>

     <br>c.	Las empresas de las que se haya adquirido un bien o servicio;<br>

     <br>d.	Extranjeros que impartan capacitación a trabajadores mexicanos en territorio nacional o cuando la capacitación se realice en el extranjero, y<br>

     <br>e.	Autoridades competentes de la Secretaría.<br>

<br><b>II.	Autentificarse por la Comisión Mixta de Capacitación, Adiestramiento y Productividad en las empresas con más de 50 trabajadores o por el patrón o representante legal en las empresas hasta con 50 trabajadores; en este último caso se omitirá la firma del representante de los trabajadores</b><br>
  
  <br>	La Comisión Mixta de Capacitación, Adiestramiento y Productividad por unanimidad de sus integrantes, podrá acordar la forma en que autentificará las constancias de habilidades laborales.
	Se podrá hacer uso de firmas en imagen digitalizada en sustitución de firmas autógrafas. En caso de elegir esta última opción, se deberán conservar en los archivos de la empresa, a disposición de la Secretaría, los convenios respectivos de la Comisión respecto del uso de las firmas autógrafas autorizadas para ser digitalizadas, así como las especificaciones para comprobar su veracidad y para garantizar su adecuado uso.<br>

	<br><b>III.	Entregarse a los trabajadores que:</b><br>
	
<br> a.	Aprueben el curso de capacitación, mediante la evaluación  correspondiente, dentro de los veinte días hábiles siguientes al término del mismo, o
<br> b.	Aprueben el examen de suficiencia, aplicado por el agente capacitador, cuando se nieguen a recibir capacitación.
<br><b>IV.	Elaborarse utilizando cualquiera de las siguientes opciones:</b><br>
<br> a.	El formato DC-3 “Constancia de competencias o de habilidades laborales”, según modelo anexo.<br>
<br>b.	El formato disponible en el sistema informático ubicado en la página de Internet www.stps.gob.mx.<br>

<br> De seleccionar esta opción, las empresas tendrán la posibilidad de emitir las constancias de competencias o de habilidades laborales de sus trabajadores a través del sistema informático, así como elaborar la lista de constancias de competencias o de habilidades laborales, incluyendo únicamente los datos faltantes.<br>
<br> c.	Un documento elaborado por la empresa al que se denominará “Constancia de Competencias o de Habilidades Laborales”, y que deberá contener, al menos, la información siguiente:<br>
<br>1.	Del trabajador: apellido paterno, materno y nombre(s); Clave Única de Registro de Población y ocupación específica en la empresa (según Catálogo);<br>
<br>2.	De la empresa: nombre o razón social (en caso de ser persona física anotar apellido paterno, materno y nombre(s) y Registro Federal de Contribuyentes con homoclave;<br>
<br>3.	Del programa de capacitación, adiestramiento y productividad: nombre del curso; duración en horas; periodo de ejecución; área temática del curso (según Catálogo);<br>
<br>4.	Nombre del Agente Capacitador Externo, cuando se trate de una institución, escuela u organismo; o nombre de la empresa cuando se trate de un instructor interno de la misma;<br>
<br>5.	Nombre y firma del instructor, en el caso de cursos a distancia, será suficiente anotar el nombre del tutor en línea, y<br>
<br>6.	Nombre y firma de los representantes de los trabajadores y de la empresa, integrantes de la Comisión Mixta de Capacitación, Adiestramiento y Productividad o en su caso del patrón o representante legal.<br>
<br>La información de los catálogos relativos a la ocupación específica del trabajador en la empresa y a las áreas temáticas del curso, para las empresas que no expidan las constancias a través del sistema informático, se encuentran disponibles en el propio sistema ubicado en la página de Internet www.stps.gob.mx, en caso contrario dichos catálogos se encuentran en el reverso del formato DC-3 “Constancia de Competencias o de Habilidades Laborales”, según modelo anexo .<br>
<br>Artículo 25. En todos los casos, se podrán incluir en las constancias de competencias o de habilidades laborales solamente los logotipos, imágenes o membretes que identifiquen a la empresa y, en su caso, al agente capacitador. A excepción de las constancias emitidas por la Secretaría, no se deberán utilizar imágenes, ni textos que identifiquen o hagan referencia a que la Secretaría avala el desarrollo, contenido o calidad de los cursos y/o que cuenta con el reconocimiento o validez por parte de la misma.<br>
<br>Artículo 26. Las empresas deberán hacer del conocimiento de la Secretaría, para su registro y control, las listas de las constancias de competencias o de habilidades laborales, que contendrán la información de la capacitación o adiestramiento otorgado a los trabajadores como resultado de las acciones realizadas conforme al plan y programas de capacitación, adiestramiento y productividad, tomando en consideración  lo siguiente:<br>
<br><b>I.	Dentro de los sesenta días hábiles posteriores al término de cada año de los planes y programas de capacitación, adiestramiento y productividad y al finalizar el mismo, aun cuando no haya cumplido un año completo, las empresas deberán presentar la información correspondiente a los siguientes rubros :</b><br>
<br>a.	Los datos generales de la empresa;<br>
<br>b.	La vigencia del plan y programas de capacitación, adiestramiento y productividad;<br>
<br>c.	Los datos generales del trabajador;<br>
<br>d.	La información de los cursos de capacitación recibidos por los trabajadores;<br>
<br>e.	Las certificaciones en Normas Técnicas de Competencia Laboral o su equivalente que, en su caso, comprueben tener los trabajadores, opcionalmente, y<br>
<br>f.	El grado máximo de estudios terminados con reconocimiento de validez oficial que los trabajadores proporcionen al patrón.<br>
	<br>Las empresas que tengan hasta 50 trabajadores podrán presentar su lista de constancias de competencias o de habilidades laborales por medios impresos o de forma electrónica.<br>
	Las empresas con más de 50 trabajadores deberán presentar su lista de constancias de competencias o de habilidades laborales, de forma electrónica.<br>
	Las empresas que no hayan registrado algún plan y programas de capacitación y adiestramiento de sus trabajadores ante la Secretaría, deberán observar lo establecido en el Artículo Primero Transitorio del presente Acuerdo.
	Cuando las empresas opten por realizar el trámite a través de medios electrónicos, deberán ingresar a la página de Internet de la Secretaría en la dirección www.stps.gob.mx, y seguir las instrucciones que se indiquen en la liga referente a la presentación de las listas de constancias de competencias o de habilidades laborales. En caso de realizarlo de manera personal, deberán presentar el formato DC-4 “Lista de constancias de competencias o de habilidades laborales”, según modelo anexo. De utilizar la primera opción, la información se incorporará a la base de datos de la Secretaría con el propósito de que en lo sucesivo sólo se hagan las actualizaciones correspondientes.<br>
<br>II.	De proceder la solicitud en tiempo y forma, la Secretaría emitirá un acuse de recibo el mismo día en que se realice la presentación de las listas de constancias, ya sea que ésta se efectúe en ventanilla o bien por medios electrónicos, en cuyo caso se proporcionará el acuse por esta misma vía;<br>
<br>III.	Las empresas deberán tener a disposición de la Secretaría, como parte de sus registros internos, copia de las constancias de competencias o de habilidades laborales expedidas a sus trabajadores durante el último año, ya  sea en papel o en archivos electrónicos que conserven la imagen de la constancia entregada, y<br>
<br><b>IV.	La Secretaría incluirá y administrará en la base de datos del Padrón de Trabajadores Capacitados, la información de los trabajadores presentada por las em
<br>presas en las listas de constancias de competencias o de habilidades laborales.</b><br>
<br>   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
       
                                        
                                        
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                   
                    </div>
                    
                    
                          <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-solid">
                                <div class="box-header">
                                	<i class="fa fa-envelope"></i>
                                    <h1 class="box-title">Contacto y soporte técnico</h1>
                                     <div class="box-tools pull-right">
            <button title="ocultar/mostrar" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-xs" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button title="" data-toggle="tooltip" data-widget="remove" class="btn btn-default btn-xs" data-original-title="Remove"><i class="fa fa-times"></i></button>
          </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                
                                	
                                	
                                	<address>
									  <strong> <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '') ?></strong><br>
									  <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.direccion', '') ?><br>
									  <abbr title="Telefono de contacto">Tel:</abbr> <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.telefono', '') ?>
									</address>
									
									<address>
									  <strong>Correo electronico</strong><br>
									  <a href="mailto:#">  <?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.correo', '') ?></a>
									  <br />
									 
									  
									</address>
									<h4>
									  <i class="fa fa-facebook-official"></i>
									  <a href="<?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.fb', '') ?>" target="blank"><?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '') ?></a>
                                	&nbsp;
                                	&nbsp;
                                		
                                	<i class="fa fa-twitter"></i>
									  <a href="<?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.tw', '') ?>" target="blank"><?= Yii::$app->keyStorage->get('com.sisacap.empresa.contacto.nombre', '') ?></a>
                                	</h4>
                                </div>
                                </div>
                                </div>
                                </div>



<?php JSRegister::begin(); ?>
<script>

$('#soaprequest').click(function() {

  $('#phcMayoristaArt').html("<img src='/img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>");

$.ajax({
type: 'POST',
url: '/articulo-mayorista/soap-req',
data: {

}, success: function(result) {

             $('#phcMayoristaArt').html(result);

               $('#datagrid').DataTable({
                'scrollX': true,
                'language': {
                            'lengthMenu': 'Display _MENU_ records per page',
                            'zeroRecords': 'Nothing found - sorry',
                            'info': 'Showing page _PAGE_ of _PAGES_',
                            'infoEmpty': 'No records available',
                            'infoFiltered': '(filtered from _MAX_ total records)'
                        }
                    });

}, error: function(result) {
     $('#phcMayoristaArt').html('Ha ocurrido un error intente mas tarde ...');
}
});
});


$('#syncrequest').click(function() {

    doAjax("/articulo-mayorista/sync-phc-resume?dashboard=true");



});



function doAjax(filterUrl) {

$('#phcMayoristaSync').html("<img src='img/loading.gif' /> <p class='text text-info'>Consultando servicio PHC Mayorista ....</p>");    

$.ajax({
type: "GET",
url: filterUrl,
data: {

}, success: function(result) {


             $('#phcMayoristaSync').html(result);

             var totalChanges = $('#totalChanges').val();

             $('#globalStatus').html((totalChanges>0)?'No sincronizado':'Sincronizado');

             $('#comparegrid').DataTable({
                'scrollX': true,
                    });

              
               $('#sync_success').click(function() {


                    doAjax("/articulo-mayorista/sync-phc-resume?filter=success&dashboard=true");
                    
                });

                $('#sync_info').click(function() {
                    

                    doAjax("/articulo-mayorista/sync-phc-resume?filter=info&dashboard=true");
                    
                });


                $('#sync_warning').click(function() {

                    doAjax("/articulo-mayorista/sync-phc-resume?filter=warning&dashboard=true");

                    
                });


                $('#sync_all').click(function() {
                    
                                            doAjax("/articulo-mayorista/sync-phc-resume?dashboard=true");
                
                                            
                 });


        $('[id^=phcform]').on('submit', function(e){
                var form = $(this);
                var formData = form.serialize();
               
                $.ajax({
                    url: form.attr("action"),
                    type: form.attr("method"),
                    data: formData,
                    success: function (data) {
                        $('#syncrequest').trigger('click');
                    },
                    error: function () {
                        alert("Error al actualizar.");
                    }
                });
                e.preventDefault();
            });


}, error: function(result) {

     $('#phcMayoristaArt').html('Ha ocurrido un error intente mas tarde ...');

}
});
}

$( document ).ready(function() {
	$('#syncrequest').trigger('click');
});




</script>
<?php JSRegister::end(); ?>                                