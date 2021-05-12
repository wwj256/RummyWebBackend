<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "score_info".
 *
 * 
 * @property int $UserID 用户编号
 * @property int $Score 用户当前金币
 * @property int $BindScore 系统赠送金币
 * @property int $LockScore 锁定金币
 * @property int $BonusScore 充值赠送金额
 * @property int LuckScore  幸运金币
 * @property int ExpScore  用户经验
 */
class ScoreInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'score_info';
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
            [['UserID', 'Score', 'BindScore', 'LockScore', 'BonusScore', 'LuckScore', 'ExpScore'], 'integer'],
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
    'Score' => 'Score',//用户当前金币
    'BindScore' => 'BindScore',//系统赠送金币
    'LockScore' => 'LockScore',//锁定金币
    'BonusScore' => 'BonusScore',//充值赠送金额
    'LuckScore' => 'LuckScore',
    'ExpScore' => 'ExpScore',
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
