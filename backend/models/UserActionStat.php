<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_action_stat".
 *
 * 
 * @property string $UniqueID 用户唯一码
 * @property int $UID 用户ID
 * @property int $Loading 加载
 * @property int $Lobby 进入大厅
 * @property int $NewGuide 打开新手引导
 * @property int $FinishGuide 完成新手引导
 * @property int $EnterPractise 进入练习场
 * @property int $EnterGold 进入金币场
 * @property int $FinishGame 完成游戏局数
 * @property int $BrakeUp 破产次数
 * @property int $BrakeOpenPayWeb 破产时打开支付页面
 * @property int $BrakeOpenActivity 破产时打开活动页面
 * @property int $OpenDraw 打开兑换页面
 * @property int $OpenVip 打开vip页面
 * @property int $OpenShare 打开分享页面
 * @property int $NetBrake 网络断开次数
 */
class UserActionStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_action_stat';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db4');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UniqueID'], 'required'],
            [['UID', 'Loading', 'Lobby', 'NewGuide', 'FinishGuide', 'EnterPractise', 'EnterGold', 'FinishGame', 'BrakeUp', 'BrakeOpenPayWeb', 'BrakeOpenActivity', 'OpenDraw', 'OpenVip', 'OpenShare', 'NetBrake'], 'integer'],
            [['UniqueID'], 'string', 'max' => 64],
            [['UniqueID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UniqueID' => 'UniqueID',//用户唯一码
    'UID' => 'UserID',
    'Loading' => 'Loading',
    'Lobby' => 'Lobby',//进入大厅
    'NewGuide' => 'OpenNewGuide',//打开新手引导
    'FinishGuide' => 'FinishGuide',//完成新手引导
    'EnterPractise' => 'EnterPractise',//进入练习场
    'EnterGold' => 'EnterGold',//进入金币场
    'FinishGame' => 'FinishGame',//完成游戏局数
    'BrakeUp' => 'BrakeUp',//破产次数
    'BrakeOpenPayWeb' => 'BrakeOpenPayWeb',//破产时打开支付页面
    'BrakeOpenActivity' => 'BrakeOpenActivity',//破产时打开活动页面
    'OpenDraw' => 'OpenDraw',//打开兑换页面
    'OpenVip' => 'OpenVip',//打开vip页面
    'OpenShare' => 'OpenShare',//打开分享页面
    'NetBrake' => 'NetBrake',//网络断开次数
        ];
    }
}
