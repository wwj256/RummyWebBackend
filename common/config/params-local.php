<?php
return [
    'APIUrl' => 'http://192.168.3.237:18080/',
    'ServerURL' => 'http://192.168.3.237:6011/',
//     'APIUrl' => 'http://15.206.188.191:18080/',
//    'ServerURL' => 'http://15.206.188.191:6011/',
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
    //用户状态 0:'正常',1=>'禁止游戏和提现',2=>'禁止登录'
    'userStatus' =>[
        'Normal',
        'Ban games and withdrawals',
        'Ban login'
    ],
    //实名认证审核
    'realInfoStatus' =>[
        '',
        'Waiting',//待审核,waiting for review
        'Succeed',//已通过
        'Fail'//未通过
    ],
    //KYC认证 卡类型
    'identityCardTypes' =>[
        'AadhaarCard',//阿尔哈达卡
        'DrivingLicence',//驾驶证
        'Passport'//护照
    ],
    //优惠券类型
    'couponTypes' =>[
        '',
        'SupremeFirstDeposit',//首冲优惠券
        '',
        ''
    ],
    //充值信息状态
    'orderInfoStatusLabels' =>[
        'Waiting',//待支付,
        'Success',//已支付
        'Cancel',//已取消
        'WithoutAddScore',//已支付未加币
        'Nnknown',//未知
    ],
    //提现订单信息状态
    'withdrawStatusLabels' =>[
        'Waiting',//中请中
        'Pass',//通过
        'Refuse',//拒绝
        'Success',//成功
        'Failure',//失败
        'Overtime',//失效
        'SystemError',//系统申请失败
        '',
        '',
    ],
    //货币变化类型1游戏,2支付,3提现,4管理员,5:返拥,6:实名认证,7: 抽奖奖励,8:破产补助
    'scoreChangeTypes' =>[
        '',
        'Game',
        'Pay',
        'Withdraw',
        'Admin',
        'PayRebate',//返佣
        'KYC',//KYC认证
        'LuckyDraw',//抽奖奖励
        'Bankruptcy',//破产补助
        'Trader'//币商
    ],
    //系统邮件类型
    'sysMailTypes' =>[
        'AllServer',//全服
        'SpecifiedChannel',//指定渠道
        'SpecifiedUser'//指定用户
    ],
    'errorCode' => [
        "0"=> "Success",
        "1"=> "Retry",
        "2"=> "ParameError",
        "3"=> "Please wait for audit.", 
        "100"=> "The room is closed. Please try another room", 
        "101"=> "Token failure", 
        "102"=> "Not enough chips", 
        "103"=> "he seat is taken", 
        "104"=> "Currently in the middle of a game,  you cannot change tables.", 
        "105"=> "Discard Error, you don't have this card", 
        "106"=> "Can't pick up Joker", 
        "107"=> "You should not play/Not your turn", 
        "108"=> "Discard Error", 
        "109"=> "Re-enter Room", 
        "110"=> "Game Sudden Close", 
        "111"=> "Proto package parsing failed", 
        "112"=> "Please draw a card first", 
        "113"=> "Cannot Draw anymore cards", 
        "114"=> "Server shutdown", 
        "115"=> "User does not exist", 
        "116"=> "Account blocked, games and withdrawals prohibited! Please contact customer service!", 
        "200"=> "Request verification code - too often", 
        "210"=> "Bind cell phone - phone number is in use", 
        "211"=> "Binding Failed, This number is already bound to another account", 
        "212"=> "Binding Failed, Verification code has expired or does not exist. ", 
        "213"=> "Binding Failed, This email is already in use. ", 
        "214"=> "Binding Failed, This FacebookID is already in use. ", 
        "215"=> "Binding Failed, This AppleID is already in use. ", 
        "216"=> "Binding Failed, This GoogleID is already in use. ", 
        "220"=> "Login failed, Verification code has expired or does not exist. ", 
        "221"=> "Login failed, Phone number does not exist", 
        "222"=> "Login failed, Account cannot be found. (ID does not exist)", 
        "223"=> "Login failed, Unavailable in your region", 
        "230"=> "Name Authetication failed, This name has already been registered.", 
        "231"=> "Dear player, your account has been banned due to illegal activity. Please contact customer service for more information and assistance.", 
        "240"=> "Unable to proceed, Incomplete user information.", 
        "241"=> "Coupon Error - Coupon conditions are not met or does not exist. ", 
        "246"=> "You have already claimed this for today.", 
        "247"=> "Activity has not started yet", 
        "248"=> "Event has ended.", 
    ],

];
