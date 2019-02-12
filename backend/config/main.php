<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);
$config = [
    'id' => 'pfast-backend',
//     'homeUrl'=>'site/index',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'w3BnewAWmCrjijzkiLucYD5Ty1Ym_V9F',
        ],

        'urlManager' => [
           'enablePrettyUrl' => false,
// 如需隐藏index.php需要'showScriptName' => false,
           'showScriptName' => false,
           //'enableStrictParsing' => false,
           //url后缀
           //'suffix' => '.shtml',
           'rules' => [
           ],
       ],
        
        'user'=>[
            'class'=>'yii\web\User',
            'identityClass' => 'backend\models\AdminUser',
            'enableAutoLogin' => true,
            'enableSession'=>true,
        ],
        'memcache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 100,
                ],
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 50,
                ],
                'useMemcached' => false , // true:memcached, false:memcache
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'language'=>'zh-CN'
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '120.26.108.229'], // 按需调整这里
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\GeneratorCommon',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\model\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/model/adminlte',
                    'default1' => '@vendor/yiisoft/yii2-gii/generators/model/default1',
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\crud\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/crud/adminlte',
                    'default1' => '@vendor/yiisoft/yii2-gii/generators/crud/default1',
                ]
            ],
        ],
    ];
}

return $config;
