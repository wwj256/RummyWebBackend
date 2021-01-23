<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_club_info".
 *
 * 
 * @property int $UserID 用户标识
 * @property int $LoyalPoints 忠诚分值
 * @property int $RedeemScore 可赎回金额
 * @property int $Level 俱乐部等级
 * @property int $Counts 每天提现次数
 * @property int $TotalScore 今日提现总金额
 * @property string $RecordTime 记录时间
 * @property string $UpdateTime 等级更新时间
 */
class UserClubInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_club_info';
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
            [['UserID', 'LoyalPoints', 'RedeemScore', 'Level', 'Counts', 'TotalScore'], 'integer'],
            [['RecordTime', 'UpdateTime'], 'safe'],
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
    'LoyalPoints' => '忠诚分值',
    'RedeemScore' => '可赎回金额',
    'Level' => '俱乐部等级',
    'Counts' => '每天提现次数',
    'TotalScore' => '今日提现总金额',
    'RecordTime' => '记录时间',
    'UpdateTime' => '等级更新时间',
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
