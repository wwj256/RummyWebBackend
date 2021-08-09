<?php
return [
    'components' => [
        // 'db' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=15.206.188.191;dbname=lami_backend',
        //     'username' => 'root',
        //     'password' => 'Lami_123456',
        //     'charset' => 'utf8',
        // ],
        // 'db2' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=15.206.188.191;dbname=lami_account',
        //     'username' => 'root',
        //     'password' => 'Lami_123456',
        //     'charset' => 'utf8',
        // ],
        // 'db3' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=15.206.188.191;dbname=lami_platform',
        //     'username' => 'root',
        //     'password' => 'Lami_123456',
        //     'charset' => 'utf8',
        // ],
        // 'db4' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=15.206.188.191;dbname=lami_record',
        //     'username' => 'root',
        //     'password' => 'Lami_123456',
        //     'charset' => 'utf8',
        // ],
        // 'db5' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=15.206.188.191;dbname=lami_deal',
        //     'username' => 'root',
        //     'password' => 'Lami_123456',
        //     'charset' => 'utf8',
        // ],

        'db' => [
           'class' => 'yii\db\Connection',
           'dsn' => 'mysql:host=127.0.0.1;dbname=lami_backend',
           'username' => 'root',
           'password' => '123456',
           'charset' => 'utf8',
       ],
       'db2' => [
           'class' => 'yii\db\Connection',
           'dsn' => 'mysql:host=127.0.0.1;dbname=lami_account',
           'username' => 'root',
           'password' => '123456',
           'charset' => 'utf8',
       ],
       'db3' => [
           'class' => 'yii\db\Connection',
           'dsn' => 'mysql:host=127.0.0.1;dbname=lami_platform',
           'username' => 'root',
           'password' => '123456',
           'charset' => 'utf8',
       ],
       'db4' => [
           'class' => 'yii\db\Connection',
           'dsn' => 'mysql:host=127.0.0.1;dbname=lami_record',
           'username' => 'root',
           'password' => '123456',
           'charset' => 'utf8',
       ],
       'db5' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=lami_deal',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],

        
       'mailer' => [
           'class' => 'yii\swiftmailer\Mailer',
           'viewPath' => '@common/mail',
           // send all mails to a file by default. You have to set
           // 'useFileTransport' to false and configure a transport
           // for the mailer to send real emails.
           'useFileTransport' => true,
       ],

    ],
    // 配置语言
//    'language'=>'zh-CN',
    'language'=>'en',
    // 配置时区
    'timeZone'=>'Asia/Chongqing',
];
