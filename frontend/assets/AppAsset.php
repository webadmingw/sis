<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/maruti/css/bootstrap.min.css',
        'themes/maruti/css/bootstrap-responsive.min.css',
        'themes/maruti/css/datepicker.css',
        'themes/maruti/css/select2.css',
//        'themes/maruti/css/jquery.gritter.css',
//        'themes/maruti/css/uniform.css',
        'themes/maruti/css/maruti-style.css',
        'themes/maruti/css/maruti-media.css',
        'vendor/fa/font-awesome.css',
        'replace-style.css',
    ];
    public $js = [
//        'themes/maruti/js/jquery.min.js',
        'themes/maruti/js/jquery.ui.custom.js',
//        'themes/maruti/js/jquery.uniform.js',
//        'themes/maruti/js/bootstrap.min.js',
        'themes/maruti/js/bootstrap-datepicker.js',
//        'themes/maruti/js/jquery.gritter.min.js',
//        'themes/maruti/js/jquery.dataTables.min.js',
//        'themes/maruti/js/maruti.js',
        'themes/maruti/js/select2.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
