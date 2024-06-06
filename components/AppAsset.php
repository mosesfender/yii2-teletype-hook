<?php

namespace tthook\components;

use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css
        = [
            'css/site.css',
        ];
    public $js
        = [
            'js/demo.js'
        ];
    public $depends
        = [
            YiiAsset::class,
            BootstrapAsset::class,
        ];
    
}