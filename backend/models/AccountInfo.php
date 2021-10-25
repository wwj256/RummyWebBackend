<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_info".
 *
 * 
 * @property int $UserID 用户编号
 * @property int $SpreadID 渠道id
 * @property int $InviteID 邀请人ID
 * @property int $PInviteID 上级邀请ID
 * @property int $RealReg 0-未填写 1-待审核 2-已通过 3-未通过
 * @property string $UniqueID 唯一标识
 * @property string $Password 登录密码
 * @property string $NickName 昵称
 * @property string $FaceUrl 头像URL
 * @property int $IsRobot 是否机器人
 * @property int $Platform 0是android，1是IOS
 * @property string $RegisterIP 注册IP
 * @property string $RegisterDate 注册时间
 * @property string $RegisterMachine 注册机器码
 * @property string $ClientVersion 最后登录版本
 * @property string $LoginIP 最后登录IP
 * @property string $LoginDate 最后登录时间
 * @property string $LoginMachine 最后登录机器码
 * @property string $Status 用户状态：0正常,1禁止游戏和提现,2禁止登陆
 */
class AccountInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lami_account.account_info';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SpreadID', 'IsRobot', 'Platform', 'Status', 'InviteID', 'PInviteID'], 'integer'],
            [['FaceUrl'], 'required'],
            [['RegisterDate', 'LoginDate'], 'safe'],
            [['UniqueID', 'FaceUrl', 'RegisterMachine', 'LoginMachine'], 'string', 'max' => 255],
            [['Password'], 'string', 'max' => 64],
            [['NickName'], 'string', 'max' => 128],
            [['RegisterIP', 'ClientVersion', 'LoginIP'], 'string', 'max' => 32],
            [['UniqueID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UserID' => 'UserID',//用户编号
    'SpreadID' => 'SpreadID',//渠道id
    'InviteID' => 'InviteID',//邀请人ID
    'PInviteID' => 'PInviteID',//上级邀请ID
    'UniqueID' => 'UniqueID',//唯一标识
    'Password' => 'Password',//登录密码
    'NickName' => 'NickName',//昵称
    'FaceUrl' => 'FaceUrl',//头像URL
    'IsRobot' => 'IsRobot',//是否机器人
    'Platform' => 'Platform',//手机型号,0是android，1是IOS
    'RegisterIP' => 'RegisterIP',//注册IP
    'RegisterDate' => 'RegisterDate',//注册时间
    'RegisterMachine' => 'RegisterMachine',//注册机器码
    'ClientVersion' => 'ClientVersion',//最后登录版本
    'LoginIP' => 'LoginIP',//最后登录IP
    'LoginDate' => 'LoginDate',//最后登录时间
    'LoginMachine' => 'LoginMachine',//最后登录机器码
        ];
    }

    public function isNewUser()
    {
        $registerTime = strtotime($this->RegisterDate) + 60*60*24;
        $nowTime = time();
        return $registerTime > $nowTime ? "1" : '0';
    }

    /*
 * ScoreInfo
 * */
    public function getScore_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(ScoreInfo::className(), ['UserID' => 'UserID']);
    }
}
