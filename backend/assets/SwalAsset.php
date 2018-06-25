<?php
/**
 * Created by PhpStorm.
 * User: BernardoEstevez
 * Date: 24/06/2018
 * Time: 08:09 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;
use yii\web\YiiAsset;

class SwalAsset extends AssetBundle
{

    public $sourcePath = '@bower/sweetalert2';

    public $js = [
        'dist/sweetalert2.all.min.js'
    ];

    public $depends = [
        YiiAsset::class,
    ];

}