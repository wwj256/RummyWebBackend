<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log_admin_trade".
 *
 * 
 * @property int $id ID
 * @property int $UserID 币商ID
 * @property int $Score 原金额
 * @property int $SChange 变化的金额
 * @property int $AdminID 管理员ID
 * @property string $UpdateTime 操作时间
 */
class LogAdminTrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_admin_trade';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'Score', 'SChange', 'AdminID'], 'integer'],
            [['UpdateTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'ID',
    'UserID' => '币商ID',
    'Score' => '原金额',
    'SChange' => '变化的金额',
    'AdminID' => '管理员ID',
    'UpdateTime' => '操作时间',
        ];
    }
}
