<?php

namespace backend\assets;

use yii\helpers\FileHelper;
use yii\web\AssetBundle;


class InspiniaAsset extends AssetBundle
{
    public $sourcePath = '@vendor/smartysoft/yii2-smartysoft-inspinia/assets/';

    public $css = [
        'css/animate.css',
        'css/style.css',
    ];

    public $js = [
        'js/jquery.metisMenu.js',
        'js/jquery.slimscroll.min.js',
        'js/inspinia.js',
        'js/pace.min.js',
        'js/wow.min.js',

    ];

    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
