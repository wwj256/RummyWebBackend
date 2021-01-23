<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_coupon_info".
 *
 * 
 * @property int $ID
 * @property int $UserID 用户id
 * @property int $Type 优惠券类型：1：首冲优惠券
 * @property int $Status 状态：0-未使用1-已使用
 * @property string $UsedTime 使用时间
 * @property string $CreateTime 创建时间
 * @property string $ExpireTime 结束使用时间
 */
class UserCouponInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_coupon_info';
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
            [['UserID', 'Type', 'Status'], 'integer'],
            [['UsedTime', 'CreateTime', 'ExpireTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'ID',
    'UserID' => 'UserID',
    'Type' => 'Type',//：1：首冲优惠券
    'Status' => 'Status',//：0-未使用1-已使用
    'UsedTime' => 'UsedTime',
    'CreateTime' => 'CreateTime',
    'ExpireTime' => 'ExpireTime',
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
