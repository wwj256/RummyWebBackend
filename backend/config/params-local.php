<?php
return [
    // 'APIUrl' => 'http://192.168.3.237:18080/',
    // 'ServerURL' => 'http://192.168.3.237:6011/',
    'APIUrl' => 'http://15.206.188.191:18080/',
   'ServerURL' => 'http://15.206.188.191:6011/',
   // 'APIUrl' => 'https://srv.rummygenius.com:18080/',
    // 'imageUploadRelativePath' => 'C:/work/src/shopres/shop/',//'./bg/', // 商品图片默认上传的目录
    'imageUploadSuccessPath' => '/shop/', // 图片上传成功后，路径前缀
    'imageUploadRelativePath1' => 'C:/work/src/shopres/config/', // 系统图片默认上传的目录
    'imageUploadSuccessPath1' => '/config/', // 系统图片上传成功后，路径前缀

    'webuploader' => [
        // 后端处理图片的地址，value 是相对的地址
        'uploadUrl' => 'goods/upload',
        // 多文件分隔符
        'delimiter' => ',',

        // 基本配置
        'baseConfig' => [
            'defaultImage' => 'http://ceshi_admin.com/it/u=2056478505,162569476&fm=26&gp=0.jpg',
            'disableGlobalDnd' => true,
            'accept' => [
                'title' => 'Images',
                'extensions' => 'gif,jpg,jpeg,bmp,png,mp4',
                'mimeTypes' => 'image/*',
            ],
            'pick' => [
                'multiple' => false,
            ],
            'compress' => false,
            'fileSizeLimit' => 10242880,
            'fileSingleSizeLimit' => 10242880,
            'threads' => 1,
        ],
    ],
    'realInfoStatus' =>[
        '',
        '待审核',
        '已通过',
        '未通过'
    ],
    'identityCardTypes' =>[
        '阿尔哈达卡',
        '驾驶证',
        '护照'
    ],
    'orderInfoStatusLabels' =>[
        '待支付',
        '已支付',
        '已取消',
        '已支付未加币',
        '未知',
    ],
    'withdrawStatusLabels' =>[
        '中请中',
        '通过',
        '拒绝',
    ],
    'scoreChangeTypes' =>[
        '',
        'Game',
        'Pay',
        'Refer',
        'Admin',
        '返佣',
        'KYC认证',
        '抽奖奖励',
        '破产补助'
    ],
    'sysMailTypes' =>[
        '全服',
        '指定渠道',
        '指定用户'
    ],

];
