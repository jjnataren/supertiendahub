<?php
/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 11/07/2018
 * Time: 11:07 AM
 */

namespace backend\models;


abstract class TipoCambio extends BaseEnum
{

    public const CAMBIO_PRECIO = 0;

    public const NUEVO = 1;

    public const HABILITAR = 2;

    public const INHABILITAR = 3;

    public const SIN_CAMBIOS = 4;

    public const ALTA_SISTEMA = 5;

}