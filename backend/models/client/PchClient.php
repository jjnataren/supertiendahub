<?php
namespace backend\models\client;

class PchClient
{

    /**
     * Gets all PCH Items online
     * @param String $wsdl
     * @param String $payload
     * @throws \Exception
     * @return array[]
     */
    public static function ObtenerListaArticulos($wsdl = null, $payload = null)
    {
        $wsdl = ($wsdl) ? $wsdl : \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8089/servidor.php?wsdl');

        $cliente = \Yii::$app->keyStorage->get('config.phc.webservice.cliente', '50527');

        $llave = \Yii::$app->keyStorage->get('config.phc.webservice.llave', '487478');

        $params = ($payload) ? $payload : "<cliente>$cliente</cliente><llave>$llave</llave>";


        try{

        $client = new \SoapClient($wsdl);
        // $valores = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;

        // $dollar = (float)$client->ObtenerParidad(['cliente'=>'50527', 'llave'=>'487478' ])->datos;

        //$soap_response = $client->ObtenerListaArticulos(new \SoapVar($params, XSD_ANYXML))->datos;
         $soap_response = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;

        }catch(\Exception  $e){

            throw $e;
        }


        $pchItemsTmp = [];

        foreach ($soap_response as $articulo)
            $pchItemsTmp[$articulo->sku] = $articulo;

        return $pchItemsTmp;
    }



    /**
     * Gets dollar value from PCH
     * @param String $wsdl
     * @param String $payload
     * @throws \Exception
     * @return number
     */
    public static function ObtenerParidad($wsdl = null, $payload = null)
    {
        $wsdl = ($wsdl) ? $wsdl : \Yii::$app->keyStorage->get('config.phc.webservice.endpoint', 'http://localhost:8089/servidor.php?wsdl');

        $cliente = \Yii::$app->keyStorage->get('config.phc.webservice.cliente', '50527');

        $llave = \Yii::$app->keyStorage->get('config.phc.webservice.llave', '487478');

        $params = ($payload) ? $payload : "<cliente>$cliente</cliente><llave>$llave</llave>";


        try{
        $client = new \SoapClient($wsdl);
        // $valores = $client->ObtenerListaArticulos(['cliente'=>'50527', 'llave'=>'487478' ])->datos;

        // $dollar = (float)$client->ObtenerParidad(['cliente'=>'50527', 'llave'=>'487478' ])->datos;


        $dollar = (float) $client->ObtenerParidad(new \SoapVar($params, XSD_ANYXML))->datos;

        }catch(\Exception  $e){
            throw $e;
        }

        return $dollar;
    }
}