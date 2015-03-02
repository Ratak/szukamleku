<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 07.02.15
 * Time: 13:57
 */

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'api/v1/regions',
            'api/v1/cities',
            'api/v1/districts',
            'api/v1/pharmacies',
            'api/v1/drugs',
        ],
    ],
    'api/v1/regions/<regionId>/cities'         => 'api/v1/cities',
    'api/v1/regions/<regionId>/pharmacies'     => 'api/v1/pharmacies',
    'api/v1/cities/<cityId>/districts'         => 'api/v1/districts',
    'api/v1/cities/<cityId>/pharmacies'        => 'api/v1/pharmacies',
    'api/v1/districts/<districtId>/pharmacies' => 'api/v1/pharmacies',
    'api/v1/pharmacies/<pharmacyId>/drugs'     => 'api/v1/drugs',
    'api/v1/drugs/<drugId>/pharmacies'         => 'api/v1/pharmacies',

//    [
//        'pattern'  => 'api/v1/user/pharmacies',
//        'route'    => 'api/v1/pharmacies',
//        'defaults' => ['user' => Yii::$app->user->getId()],
//    ],
];