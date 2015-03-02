<?php


require(__DIR__ . '/vendor/yiisoft/yii2/BaseYii.php');

class Yii extends \yii\BaseYii
{
    /**
     * @var WebApplication
     */
    public static $app;
}

/**
 * @property \app\components\LanguageUrlManager  $urlManager
 * @property \app\components\LanguageRequest     $request
 * @property \app\components\Settings            $settings
 * @property \app\components\User                $user
 * @property \yii\rbac\PhpManager                $authManager
 * @property \yii\caching\FileCache              $cache
 * @property \yii\swiftmailer\Mailer             $mailer
 */
class WebApplication extends yii\web\Application {}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;
