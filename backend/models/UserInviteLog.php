<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_invite_log".
 *
 * 
 * @property int $ID
 * @property int $UserID 用户ID
 * @property int $InviteUID  被邀请人ID
 * @property int $RelateID 0邀请,其他为充值ID
 * @property int $OutBonus 贡献奖金
 * @property string $UpdateTime 日期
 */
class UserInviteLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_invite_log';
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
//            [['ID', 'UserID'], 'required'],
            [['UserID'], 'required'],
            [['ID', 'UserID', 'InviteUID', 'RelateID', 'OutBonus'], 'integer'],
            [['UpdateTime'], 'safe'],
            [['UserID', 'UpdateTime'], 'unique', 'targetAttribute' => ['UserID', 'UpdateTime']],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'Log ID',
    'UserID' => '用户ID',
    'InviteUID' => ' 被邀请人ID',
    'RelateID' => '0邀请,其他为充值ID',
    'OutBonus' => '贡献奖金',
    'UpdateTime' => '日期',
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
