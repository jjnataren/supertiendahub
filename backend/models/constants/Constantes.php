<?php
namespace backend\models\constants;

class Constantes
{


      const CURRENCY_MX  = 1;
      const CURRENCY_US  = 2;

      const ML_RATE_BASIC = 1;
      const ML_RATE_PREMIUM = 2;


      const HUB_UT_PERCENT  = 1;
      const HUB_UT_AMOUNT  = 2;

      const HUB_UT_PERCENT_STR  = 'Porcentaje';
      const HUB_UT_AMOUNT_STR  = 'Monto';


      const TALLER_ESTATUS_NO_DISPONIBLE = 0;
      const TALLER_ESTATUS_POR_IMPARTIR = 1;
      const TALLER_ESTATUS_IMPARTIENDO = 2;
      const TALLER_ESTATUS_FINALIZADO = 3;

    public static $TALLER_ESTATUS_DESC= [Constantes::TALLER_ESTATUS_NO_DISPONIBLE => 'No disponible',
        Constantes::TALLER_ESTATUS_POR_IMPARTIR => 'Por imartir',
        Constantes::TALLER_ESTATUS_IMPARTIENDO => 'Impartiendo',
        Constantes::TALLER_ESTATUS_FINALIZADO => 'Finalizado'
    ];


    public static $HUB_UTILIDADES = [Constantes::HUB_UT_PERCENT => Constantes::HUB_UT_PERCENT,
        Constantes::HUB_UT_AMOUNT => Constantes::HUB_UT_AMOUNT_STR

    ];

    /**
     *
     */
    public static function getTallerEstatusDesc($id){
        return isset(Constantes::$TALLER_ESTATUS_DESC[$id])?Constantes::$TALLER_ESTATUS_DESC[$id]:'Desconocido';
    }


}

