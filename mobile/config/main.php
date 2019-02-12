<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-mobile',
    'language'=>'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' =>'index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'mobile\controllers',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7EmI1aODEGmCo7LwyKBilJ3WKe45oMsv',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
//            'suffix'=>'.html',
            'rules' => [
//                'index' => 'index/index',
                '' => 'index/index',
                'quote' => 'index/quote',
                'transaction' => 'index/transaction',
                'user' => 'index/user',
            ],
        ],
    ],
    'params' => $params,
];
