<?php

namespace backend\models;

/**
 * ArticuloSearch represents the model behind the search form about `backend\models\Articulo`.
 */
class ArticuloComp extends Articulo{

    public $precioPs;
    public $actualizaCantidadPs = false;
    public $idPs;
    public $precioPsOriginal;



    public function attributeLabels()
    {
        return [

            'actualizaCantidadPs' => '¿Restar en Super tienda?',];
    }

}