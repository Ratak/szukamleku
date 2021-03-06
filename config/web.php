<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Szukamleku',
    'basePath' => dirname(__DIR__),
    'timeZone' => 'Europe/Kiev',
    'language' => 'ru',
    'bootstrap' => [
        'log',
        'app\components\ModuleBootstrap',
    ],
    'components' => [
        'settings' => [
            'class' => 'app\components\Settings'
        ],
        'urlManager' => [
            'class' => 'app\components\LanguageUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [
                '<alias:signup|login|logout|recover|recover-confirmation>' => 'auth/<alias>',
                'admin' => 'admin/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['guest', 'manager', 'admin'],
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            'class' => 'app\components\LanguageRequest',
            'cookieValidationKey' => 'jwXfKCBGgnoSpFuZllNaPI3WnkNmr0Cv',
        ],
        'cache' => [
            'class' => 'yii\caching\XCache',
        ],
        'user' => [
            'class' => 'app\components\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\GettextMessageSource',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'api'      => 'app\modules\api\Module',
        'gridview' => '\kartik\grid\Module',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';

    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*', '127.0.0.1', '::1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
