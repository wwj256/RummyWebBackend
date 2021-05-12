<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_record_player".
 *
 * 
 * @property int $UID 用户ID
 * @property int $RcdId 记录ID
 * @property int $Turns 轮数
 * @property int $NewUser 是否新用户
 * @property int $SpreadID 渠道ID
 * @property int $BeginScore 初始分数
 * @property int $WinScore 赢分数
 * @property int $Bind
 * @property int $BindChg
 * @property int $Bonus 原始赠送金币
 * @property int $BonusChg 赠送金币变化
 * @property int $PlyTax 税收
 * @property int $BrokeUp 是否破产,1为破产
 * @property string $BeginTime 开始时间
 */
class GameRecordPlayer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_record_player';
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
            [['UID', 'RcdId', 'Turns','BrokeUp'], 'required'],
            [['UID', 'RcdId', 'Turns', 'NewUser', 'SpreadID', 'BeginScore', 'WinScore', 'Bind', 'BindChg', 'Bonus', 'BonusChg', 'PlyTax'], 'integer'],
            [['BeginTime'], 'safe'],
            [['UID', 'RcdId', 'Turns'], 'unique', 'targetAttribute' => ['UID', 'RcdId', 'Turns']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UID' => 'UserID',
    'RcdId' => 'RcdId',//记录ID
    'Turns' => 'Turns',//轮数
    'NewUser' => 'IsNewUser',//是否新用户
    'SpreadID' => 'SpreadID',//渠道ID
    'BeginScore' => 'BeginScore',//初始总金币
    'WinScore' => 'WinScore',//总金币变化量
    'Bind' => 'Bind',//原绑定金币
    'BindChg' => 'BindChg',//绑定金币变化量
    'Bonus' => 'Bonus',//原始赠送金币
    'BonusChg' => 'BonusChg',//赠送金币变化
    'PlyTax' => 'Tax',//税收
    'BrokeUp' => 'BrokeUp',//是否破产,1为破产
    'BeginTime' => 'BeginTime',//开始时间
        ];
    }


    /*
     * 关联AccountInfo
     * */
    public function getaccount_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(AccountInfo::className(), ['UserID' => 'UID']);
    }
}
