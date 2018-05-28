<?php

namespace console\controllers;

use yii\console\Controller;
use common\commands\AddToTimelineCommand;
use Yii;
use common\commands\SendEmailCommand;
use yii\helpers\Url;
use backend\models\ArticuloMayorista;


/**
 * Test controller
 */
class SuperTiendaController extends Controller {
    
    public function actionIndex() {
        echo "cron service runnning";
        
        
        $this->syncPHC();
    }
    
    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }
    
    
    public function actionHourly() {
        // every hour
        $current_hour = date('G');
      
        if ($current_hour%4) {
            // every four hours
        }
        if ($current_hour%6) {
            // every six hours
        }
        
        
    }
    
    


    private static  function syncPHC(){
        
        $numeroCambios = 0;
        
        
        $wsdl = "http://localhost:8088/servidor.php?wsdl";
        $params = "<cliente>50527</cliente><llave>487478</llave>";
        $client = new \SoapClient($wsdl);
        $soap_response = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;
        //TODO: Optimize search proccess
        
        $articles = [];
        
        foreach ($soap_response as $articulo){
            
            $model =  new ArticuloMayorista();
            $model->attributes = get_object_vars($articulo);
            
            $dbModel = ArticuloMayorista::findOne($model->sku);
            
            
            
            if (  !$dbModel || $dbModel->precio*1 !==  $model->precio*1)
                $articles[$model->sku] = ['dbmodel'=>$dbModel->attributes, 'model'=>$model->attributes];
                
        }
        
        
        if (count($articles)){
                
        \Yii::$app->mailer->compose()
        ->setTo( \Yii::$app->keyStorage->get('config.phc.aviso.correo', 'jjnataren@hotmail.com'))
        ->setSubject('PHC Mayoristas ha cambiado articulos')
        ->setTextBody('PHC Mayoristas ha cambiado articulos')
        ->setHtmlBody('<h1>PHC Mayoristas ha cambiado artículos</h1>
                          <p> En el siguiente <a href="http://supertiendahub.local/articulo-mayorista" targer="_blank">Enlace</a> podra ver el detalle.  </p>  
                    
                        ')
        ->send();
       
        
        $addToTimelineCommand = new AddToTimelineCommand([
            'category' => 'phc',
            'event' => 'change',
            'data' => ['articles' => $articles]
        ]);
        
        
        Yii::$app->commandBus->handle($addToTimelineCommand);
        
        }else       
            echo 'There are not changes in phc';
    }
    
    
}

