<?php
/**
 * Created by jjnataren.
 * User: dreadber
 * Date: 19/09/2018
 * Time: 1:20
 */

namespace backend\models\util;


use backend\models\constants\Constantes;

class Util extends \Exception
{



    /**
     *
     * @param float $price
     * @param float $util
     * @param float $dollar
     * @param int $currency
     * @param int $hubUtility
     * @return number
     */
    public static function getPSFinalprice($price,
        $util,
        $dollar,
        $currency=Constantes::CURRENCY_MX,
        $hubUtility=Constantes::HUB_UT_PERCENT
        ) {


           $price = ( ($currency == Constantes::CURRENCY_US) ? ($price * $dollar) : $price );

           return  $price += (($hubUtility == Constantes::HUB_UT_PERCENT) ? ($price * ($util/100)) : (($hubUtility == Constantes::HUB_UT_AMOUNT) ? $util : 0));

    }





    /**
     *
     * @param float $price
     * @param float $util
     * @param float $dollar
     * @param int $currency
     * @param int $hubUtility
     * @param int $rate
     * @return number
     */
    public static function getMLFinalprice($price,
                                           $util,
                                           $dollar,
                                           $currency=Constantes::CURRENCY_MX,
                                           $hubUtility=Constantes::HUB_UT_PERCENT,
                                           $rate = Constantes::ML_RATE_BASIC
                                           ) {

        $price=($currency == 2)?
                    $price*$dollar:
                        $price;

        $IVA = 1.16;//TO-DO: get this value by cache key-value
        $price += ($hubUtility === Constantes::HUB_UT_AMOUNT) ?  $util : (($hubUtility == Constantes::HUB_UT_PERCENT) ?  $price * $util : 0) ;
        $price *= $IVA;
        $mlUtility = 0;


        if ($rate*1 ==Constantes::ML_RATE_BASIC){

            if ($price*1 < 1001){

                $mlUtility =  $price * 0.13;
            }elseif ($price*1 < 5001){

                $mlUtility = (130 +  (($price-1000) * 0.1)) ;
            }else{

                $mlUtility = (530 +  (($price-5000) * 0.07) );
            }

        }elseif($rate*1 == Constantes::ML_RATE_PREMIUM){

            if ($price*1 < 1001){

                $mlUtility = ( $price * 0.175);

            }elseif ($price*1 < 5001){

                $mlUtility = ( (175 +  (($price-1000) * 0.145))  );
            }else{

                $mlUtility = ( (755 +  (($price-5000) * 0.115) ) );
            }

        }

        return $price  + $mlUtility;
    }

}