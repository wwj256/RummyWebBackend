<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_login_out".
 *
 * 
 * @property int $ID
 * @property int $UID 用户ID
 * @property int $IsLogin 0:登出,1:登入
 * @property int $SpreadID 渠道ID
 * @property int $IsNew 1:新用户,0: 老用户
 * @property int $OnTime 在线时间
 * @property string $UpdateTime 日志时间
 */
class UserLoginOut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_login_out';
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
            [['UID', 'IsLogin', 'SpreadID', 'IsNew', 'OnTime'], 'integer'],
            [['UpdateTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'LogID',
    'UID' => 'UserID',
    'IsLogin' => 'IsLogin',//0:登出,1:登入
    'SpreadID' => 'SpreadID',//渠道ID
    'IsNew' => 'IsNewUser',//1:新用户,0: 老用户
    'OnTime' => 'OnlineTime',//在线时间
    'UpdateTime' => 'UpdateTime',
        ];
    }

    /*
 * 关联AccountInfo
 * */
    public function getaccount_info()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(AccountInfo::className(), ['UserID' => 'UID']);
    }
}
