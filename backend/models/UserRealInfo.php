<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_real_info".
 *
 * 
 * @property int $UserID 用户标识
 * @property int $Type 类型0-阿尔哈达卡1-驾驶证2-护照
 * @property string $FrontUrl 身份证正面地址
 * @property string $BackUrl 身份证背面地址
 * @property string $Name 姓名
 * @property string $CardID 身份证号
 * @property string $Birth 生日
 * @property string $Address 地址
 * @property int $Status 审核状态1-待审核 2-已通过 3-未通过
 * @property string $RecordTime 时间
 */
class UserRealInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_real_info';
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
            [['UserID', 'Type', 'Status'], 'integer'],
            [['RecordTime'], 'safe'],
            [['FrontUrl', 'BackUrl', 'Name', 'CardID', 'Birth', 'Address'], 'string', 'max' => 255],
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
    'Type' => '类型0-阿尔哈达卡1-驾驶证2-护照',
    'FrontUrl' => '身份证正面地址',
    'BackUrl' => '身份证背面地址',
    'Name' => '姓名',
    'CardID' => '身份证号',
    'Birth' => '生日',
    'Address' => '地址',
    'Status' => '审核状态1-待审核 2-已通过 3-未通过',
    'RecordTime' => '时间',
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
