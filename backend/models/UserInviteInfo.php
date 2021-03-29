<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_invite_info".
 *
 * 
 * @property int $UserID 用户标识
 * @property int $MyInviter 我的邀请人
 * @property int $InviteCounts 总邀请人数
 * @property int $TotalBonus 总奖金
 * @property int $InviteBonus 邀请奖金
 * @property int $DepositBonus 充值奖金
 * @property int $TodayOutBonus 今天贡献奖金
 * @property int $TotalOutBonus 总贡献奖金
 * @property string $RecordTime 记录时间
 */
class UserInviteInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_invite_info';
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
            [['UserID'], 'required'],
            [['UserID', 'MyInviter', 'InviteCounts', 'TotalBonus', 'InviteBonus', 'DepositBonus', 'TodayOutBonus', 'TotalOutBonus'], 'integer'],
            [['RecordTime'], 'safe'],
            [['UserID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UserID' => '用户标识',
    'MyInviter' => '我的邀请人',
    'InviteCounts' => '总邀请人数',
    'TotalBonus' => '总奖金',
    'InviteBonus' => '邀请奖金',
    'DepositBonus' => '充值奖金',
    'TodayOutBonus' => '今天贡献奖金',
    'TotalOutBonus' => '总贡献奖金',
    'RecordTime' => '记录时间',
        ];
    }

    /*
     * AccountInfo
     * */
    public function getaccount_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(AccountInfo::className(), ['UserID' => 'UserID']);
    }


}
