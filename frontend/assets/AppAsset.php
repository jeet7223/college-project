<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/style.css',
        'css/custom.css',
        'css/responsive.css',
        'css/baguetteBox.min.css',
        'css/classic.css',
        'css/font-awesome.min.css',
        'css/superslides.css',
        'css/site.css',
        'css/animate.css',
    ];
    public $js = [
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/jquery.superslides.min.js',
        'js/images-loded.min.js',
        'js/isotope.min.js',
        'js/baguetteBox.min.js',
        'js/form-validator.min.js',
        'js/contact-form-script.js',
        'js/custom.js',
        'js/contact-form-script.js',
        'js/legacy.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
