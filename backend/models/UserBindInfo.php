<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_bind_info".
 *
 * 
 * @property int $UserID 用户标识
 * @property string $UniqueID
 * @property string $Phone 绑定手机号
 * @property string $FacebookID 绑定facebook账号
 * @property string $Mail 绑定邮箱
 * @property string $GoogleID 绑定google账号
 * @property string $RealName 真实姓名
 * @property string $PayName 支付人姓名
 * @property string $PayPhone 支付人手机号
 * @property string $PayEmail 支付人邮箱
 */
class UserBindInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_bind_info';
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
            [['UserID', 'UniqueID'], 'required'],
            [['UserID'], 'integer'],
            [['UniqueID', 'Phone', 'FacebookID', 'Mail', 'GoogleID', 'RealName', 'PayName', 'PayPhone', 'PayEmail'], 'string', 'max' => 64],
            [['UserID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UserID' => 'UserID',
    'UniqueID' => 'UniqueID',
    'Phone' => 'Phone',//绑定手机号
    'FacebookID' => 'FacebookID',//绑定facebook账号
    'Mail' => 'Mail',//绑定邮箱
    'GoogleID' => 'GoogleID',//绑定google账号
    'RealName' => 'RealName',//真实姓名
    'PayName' => 'PayName',//支付人姓名
    'PayPhone' => 'PayPhone',//支付人手机号
    'PayEmail' => 'PayEmail',//支付人邮箱
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
