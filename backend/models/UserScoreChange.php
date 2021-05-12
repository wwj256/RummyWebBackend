<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_score_change".
 *
 * 
 * @property int $ID
 * @property int $UID 用户标识
 * @property int $NewUser 1:新用户,0:老用户
 * @property int $SpreadID 渠道ID
 * @property int $SType 1游戏,2支付,3提现,4管理员,5:返拥
 * @property int $Score 原始分数
 * @property int $SChange 变化量
 * @property int $Bind 原绑定金币
 * @property int $BindChg 绑定金币变化
 * @property int $Bonus 原始赠送金币
 * @property int $BonusChg 赠送金币变化
 * @property int $Luck 幸运金币
 * @property int $LuckChg 幸运金币变更
 * @property int $RelateID 关联ID，SType=2兑换券ID，SType=1游戏记录ID，SType=4管理员ID，，SType=5被邀请人ID,，SType=6被邀请人充值ID
 * @property string $Reason 原因
 * @property string $UpdateTime 记录时间
 */
class UserScoreChange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_score_change';
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
            [['UID'], 'required'],
            [['UID', 'NewUser', 'SpreadID', 'SType', 'Score', 'SChange', 'Bind', 'BindChg', 'Bonus', 'BonusChg', 'RelateID','Luck','LuckChg'], 'integer'],
            [['UpdateTime'], 'safe'],
            [['Reason'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => '',
    'UID' => 'UserID',//用户标识
    'NewUser' => 'IsNewUser',//1:新用户,0:老用户
    'SpreadID' => 'SpreadID',//渠道ID
    'SType' => 'ChangeType',//1游戏,2支付,3提现,4管理员,5:返拥
    'Score' => 'Score',//原始分数
    'SChange' => 'ScoreChange',//变化量
    'Bind' => 'BindScore',//原绑定金币
    'BindChg' => 'BindScoreChg',//绑定金币变化
    'Bonus' => 'Bonus',//原始赠送金币
    'BonusChg' => 'BonusChg',//赠送金币变化
    'Luck' => 'Luck',//幸运金币
    'LuckChg' => 'LuckChg',//幸运金币变更
    'RelateID' => 'RelateID',//关联ID，SType=2兑换券ID，SType=1游戏记录ID，SType=4管理员ID，，SType=5被邀请人ID,，SType=6被邀请人充值ID
    'Reason' => 'Reason',//原因
    'UpdateTime' => 'UpdateTime',//记录时间
        ];
    }

    /*
 * AccountInfo
 * */
    public function getaccount_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(AccountInfo::className(), ['UserID' => 'UID']);
    }
}
