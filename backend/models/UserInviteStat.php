<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_invite_stat".
 *
 * 
 * @property int $UID 用户ID
 * @property string $DayStat 日期
 * @property int $TotalBonus 总奖金
 * @property int $InviteBonus 日总邀请奖金
 * @property int $DepositBonus 日总支付奖金
 */
class UserInviteStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_invite_stat';
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
            [['UID', 'DayStat'], 'required'],
            [['UID', 'TotalBonus', 'InviteBonus', 'DepositBonus'], 'integer'],
            [['DayStat'], 'safe'],
            [['UID', 'DayStat'], 'unique', 'targetAttribute' => ['UID', 'DayStat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UID' => '用户ID',
    'DayStat' => '日期',
    'TotalBonus' => '总奖金',
    'InviteBonus' => '日总邀请奖金',
    'DepositBonus' => '日总支付奖金',
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
