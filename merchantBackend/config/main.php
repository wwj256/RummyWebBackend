<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-merchantBackend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'merchantBackend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    "modules" => [
        "admin" => [
            "class" => "mdm\admin\Module",
//            "layout"=>"left-menu",
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '上传目录',
            'uploadUrl' => '图片可访问地址',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
    "aliases" => [
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //controller/action
            // * 表示允许所有，后期会介绍这个
//            '*'
            'site/*'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-merchantBackend',
        ],
        'user' => [
            'identityClass' => 'backend\models\UserDeal',
            'enableAutoLogin' => true,
            'authTimeout' => 60,// 登陆有效时间
            'identityCookie' => ['name' => '_identity-merchantBackend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-merchantBackend',
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
            //用于表明 urlManager 是否启用URL美化功能
            "enablePrettyUrl" => true, //美化url==ture
            // 是否在URL中显示入口脚本
            'showScriptName' => false,//隐藏index.php
            'enableStrictParsing' => false,  //不启用严格解析
            'rules' => [
            ],
        ],
        "authManager" => [
            "class" => 'yii\rbac\DbManager',
            "defaultRoles" => ["guest"],
//            'bundles' => [
//                'dmstr\web\AdminLteAsset' => [
//                    'skin' => 'skin-yellow', //配置颜色 skin-red skin-blue skin-yellow skin-black
//                ],
//            ],
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function($event) {
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, ['merchantBackend\components\AdminLog', 'write']);
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE, ['merchantBackend\components\AdminLog', 'write']);
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_DELETE, ['merchantBackend\components\AdminLog', 'write']);
        //\yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_FIND, ['merchantBackend\components\AdminLog', 'write']);
        //\yii\base\Event::on(\yii\web\User::className(), \yii\web\User::EVENT_AFTER_LOGIN, ['merchantBackend\components\AdminLog', 'write']);
        //\yii\base\Event::on(\yii\db\BaseActiveRecord::className(),yii\web\User::EVENT_AFTER_LOGIN, ['common\models\LoginForm', 'onAfterLogin']);
    },
];
