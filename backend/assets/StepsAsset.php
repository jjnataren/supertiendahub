<?php
/**
 * Created by PhpStorm.
 * User: dreadber
 * Date: 05/06/2018
 * Time: 01:48 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;
use yii\web\YiiAsset;

class StepsAsset extends AssetBundle
{

    public $sourcePath = '@bower/jquery-steps';

    public $css = [
        'demo/css/jquery.steps.css',
    ];

    public $js = [
        'build/jquery.steps.min.js'
    ];

    public $depends = [
        YiiAsset::class,
    ];

}