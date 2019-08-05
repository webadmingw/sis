<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/maruti/css/bootstrap.min.css',
        'themes/maruti/css/bootstrap-responsive.min.css',
        'themes/maruti/css/maruti-login.css',
        'vendor/fa/font-awesome.css',
        'replace-style.css',
    ];
    public $js = [
//        'themes/maruti/js/maruti.login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
