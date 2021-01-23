<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_order_info".
 *
 * 
 * @property int $ID
 * @property string $OrderID 订单ID
 * @property int $UserID 用户ID
 * @property int $SpreadID 渠道ID
 * @property int $NewUser 1:new user
 * @property int $ScoreAmount 订单金额
 * @property int $UserEndScore 充值后金额
 * @property int $BindBonus 绑定金币
 * @property int $CouponID 优惠券ID
 * @property int $Amount 支付金额
 * @property int $Status 状态0-待支付 1-已支付 2-已取消 3-已支付未加币
 * @property string $ReferenceId Transaction reference ID, if payment has been attempted
 * @property string $PaymentMode Payment mode of transaction, if payment has been attempted
 * @property string $PayTime 支付时间
 * @property string $CreateTime 创建时间
 */
class UserOrderInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_order_info';
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
            [['UserID', 'SpreadID', 'NewUser', 'ScoreAmount', 'UserEndScore', 'BindBonus', 'CouponID', 'Amount', 'Status'], 'integer'],
            [['PayTime', 'CreateTime'], 'safe'],
            [['OrderID', 'ReferenceId', 'PaymentMode'], 'string', 'max' => 64],
            [['OrderID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => '',
            'OrderID' => '订单ID',
            'UserID' => '用户ID',
            'SpreadID' => '渠道ID',
            'NewUser' => 'isNewUser',//1:new user
            'ScoreAmount' => '订单金额',
            'UserEndScore' => '充值后金额',
            'BindBonus' => '绑定金币',
            'CouponID' => '优惠券ID',
            'Amount' => '支付金额',
            'Status' => 'Status',//状态0-待支付 1-已支付 2-已取消 3-已支付未加币
            'ReferenceId' => 'ReferenceId',//Transaction reference ID, if payment has been attempted
            'PaymentMode' => 'PaymentMode',//'Payment mode of transaction, if payment has been attempted',
            'PayTime' => '支付时间',
            'CreateTime' => '创建时间',
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
