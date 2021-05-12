<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_mail_info".
 *
 * 
 * @property int $ID
 * @property int $SysID 系统邮件ID
 * @property int $UserID 用户标识
 * @property string $Title 邮件标题
 * @property string $Content 邮件内容
 * @property int $Status 状态0-未读1-已读
 * @property string $SendTime 发送时间
 * @property string $ExpireTime 过期时间
 */
class UserMailInfo extends \yii\db\ActiveRecord
{
    public $UserIDs;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_mail_info';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SysID', 'UserID', 'Status'], 'integer'],
            [['UserID','Title','Content'], 'required'],
            [['Content'], 'string'],
            [['SendTime', 'ExpireTime'], 'safe'],
            [['Title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'MailID',
    'SysID' => 'SysID',//系统邮件ID
    'UserID' => 'UserID',//用户标识
    'Title' => 'Title',//邮件标题
    'Content' => 'Content',//邮件内容
    'Status' => 'Status',//状态0-未读1-已读
    'SendTime' => 'SendTime',//发送时间
    'ExpireTime' => 'ExpireTime',//过期时间
    'UserIDs' => 'UserIDs',//用户ID,如果多人,用英文逗号分隔,
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
