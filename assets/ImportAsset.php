<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class ImportAsset extends AssetBundle
{
    public $basePath = '@webroot/js/import';
    public $baseUrl = '@web/js/import';
    public $js = [
        'alertify.min.js',
        'import.js',
        'shim.js',
    ];
    public $css = [
        'alertify.min.css',
        'bootstrap.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}