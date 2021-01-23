<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_withdraw_info".
 *
 * 
 * @property int $ID 提现ID
 * @property int $UserID 用户ID
 * @property int $Amount 提现金额
 * @property int $BeforeScore 提现前金额
 * @property int $Tax 手续费
 * @property int $Status 状态 0-申请中，1-通过，2-拒绝
 * @property string $Desc 拒绝原因
 * @property int $ClubLV 俱乐部等级
 * @property int $OperatorID 操作员ID
 * @property string $OperatorTime 操作员时间
 * @property string $WithDrawTime 提现时间
 * @property string $CreateTime 创建时间
 */
class UserWithdrawInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_withdraw_info';
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
            [['UserID', 'Amount'], 'required'],
            [['UserID', 'Amount', 'BeforeScore', 'Tax', 'Status', 'ClubLV', 'OperatorID'], 'integer'],
            [['OperatorTime', 'WithDrawTime', 'CreateTime'], 'safe'],
            [['Desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => '提现ID',
            'UserID' => '用户ID',
            'Amount' => '提现金额',
            'BeforeScore' => '提现前金额',
            'Tax' => '手续费',
            'Status' => '状态',// 0-申请中，1-通过，2-拒绝
            'Desc' => '拒绝原因',
            'ClubLV' => '俱乐部等级',
            'OperatorID' => '操作员ID',
            'OperatorTime' => '操作员时间',
            'WithDrawTime' => '提现时间',
            'CreateTime' => '申请时间',
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
    public function getuser_backend()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(UserBackend::className(), ['id' => 'OperatorID']);
    }
}
