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
            'OrderID' => 'OrderID',//订单ID
            'UserID' => 'UserID',//用户ID
            'SpreadID' => 'SpreadID',//渠道ID
            'NewUser' => 'isNewUser',//1:new user
            'ScoreAmount' => 'ActualAmount',//实际到账金额,支付不成功时为0，只有支付成功时才显示具体值
            'UserEndScore' => 'UserEndScore',//充值后金额
            'BindBonus' => 'BindBonus',//绑定金币
            'CouponID' => 'CouponID',//优惠券ID
            'Amount' => 'PayAmount',//支付金额
            'Status' => 'Status',//状态0-待支付 1-已支付 2-已取消 3-已支付未加币,3是一种错误状态，用户支付成功了，但是后台没有加币，需要单独处理
            'ReferenceId' => 'ReferenceID',//Transaction reference ID, if payment has been attempted
            'PaymentMode' => 'PaymentMode',//'Payment mode of transaction, if payment has been attempted',
            'PayTime' => 'PayTime',//支付时间
            'CreateTime' => 'CreateTime',//创建时间
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

    /*
     * AccountInfo
     * */
    public function getuser_bind_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(UserBindInfo::className(), ['UserID' => 'UserID']);
    }
}
