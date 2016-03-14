<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'v1/css/style.css',
        'v1/css/preloader.css',
        'v1/css/font-awesome.min.css',
        'css/sweetalert2.css',
    ];

    public $js = [
        'v1/js/jquery.easyModal.js',
        'v1/js/main.js',
        'js/masonry.pkgd.min.js',
        'js/application.js',
        'js/sweetalert2.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'common\assets\Html5shiv',
        //'yii\bootstrap\BootstrapAsset'
    ];
}
