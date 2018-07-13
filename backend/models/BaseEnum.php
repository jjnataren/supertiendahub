<?php
/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 11/07/2018
 * Time: 11:02 AM
 */

namespace backend\models;


use ReflectionClass;

abstract class BaseEnum
{

    private static $constCacheArray;

    /**
     * @param $name
     * @param bool $strict
     * @return bool
     * @throws \ReflectionException
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return \in_array(strtolower($name), $keys);
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    private static function getConstants()
    {
        if (self::$constCacheArray === NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = static::class;
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     * @throws \ReflectionException
     */
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());
        return \in_array($value, $values, $strict);
    }

}