<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_mail_info".
 *
 * 
 * @property int $ID
 * @property int $SpreadID 渠道ID，0为所有渠道
 * @property string $Title 邮件标题
 * @property string $Content 邮件内容
 * @property string $SendTime 发送时间
 * @property string $ExpireTime 过期时间
 */
class SysMailInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_mail_info';
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
            [['SpreadID'], 'integer'],
            [['Content'], 'required'],
            [['Content'], 'string'],
            [['SendTime', 'ExpireTime'], 'safe'],
            [['Title'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'MailID',
            'SpreadID' => 'SpreadID',//，0为所有渠道
            'Title' => 'Title',
            'Content' => 'Content',
            'SendTime' => 'SendTime',
            'ExpireTime' => 'ExpireTime',
        ];
    }
}
