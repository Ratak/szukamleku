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
    'bootstrap' => ['log'],
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
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/v1/regions',
                        'api/v1/cities',
                        'api/v1/districts',
                        'api/v1/drugs',
                        'api/v1/pharmacies',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'letyii\rbaccached\RbacCached',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            'class' => 'app\components\LanguageRequest',
            'cookieValidationKey' => 'jwXfKCBGgnoSpFuZllNaPI3WnkNmr0Cv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\components\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
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
