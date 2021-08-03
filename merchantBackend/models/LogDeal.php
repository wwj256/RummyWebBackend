<?php

namespace merchantBackend\models;

use Yii;

/**
 * This is the model class for table "log_deal".
 *
 * 
 * @property int $ID 日志ID
 * @property int $UserID 币商ID
 * @property int $Type 交易类型：0:卖出 1:买入
 * @property int $Score 币商原始金币数
 * @property int $DealScore 交易金币数
 * @property int $TargetID 目标用户ID
 * @property string $TargetPhone 目标用户手机号
 * @property string $UpdateTime 交易时间
 */
class LogDeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_deal';
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
            [['UserID'], 'required'],
            [['UserID', 'Type', 'Score', 'DealScore', 'TargetID'], 'integer'],
            [['UpdateTime'], 'safe'],
            [['TargetPhone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'Sr. No.',
    'UserID' => 'TraderID',
    'Type' => 'Transaction Type',
    'Score' => 'Pre-Transaction Balance',
    'DealScore' => 'Transaction Amount',
    'TargetID' => 'User ID',
    'TargetPhone' => 'User Mobile #',
    'UpdateTime' => 'Transaction Time',
        ];
    }
}
