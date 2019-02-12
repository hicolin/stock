<?php
return [
    'timeZone'=>'Asia/Chongqing',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache2',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=stock_12315mq_c',
            'username' => 'stock_12315mq_c',
            'password' => '7Z84twYCrR4XSnmb',
            'charset' => 'utf8',
            'tablePrefix'=>'admin_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => '13913685333@163.com',
                'password' => 'ytx168168168',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['hk_ytx@163.com'=>'赢天下']
            ],
        ],
        'urlManager' => [
//美化URL
            'enablePrettyUrl' => true,
// 如需隐藏index.php需要'showScriptName' => false,
            'showScriptName' => false,
            'enableStrictParsing' => false,
//网址匹配规则, 不要求网址严格匹配，则不需要输入rules
            'rules' => [
//                'posts' => 'post/index',
//                'post/<id:\d+>' => 'post/view',
//                '<controller>/<id:\d+>' => '<controller>/view',
            ],
        ],

    ],
    
];
