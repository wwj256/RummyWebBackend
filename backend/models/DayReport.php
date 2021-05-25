<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "day_report".
 *
 * 
 * @property string $DayDate 日期
 * @property int $NewPlayers 新注册玩家数
 * @property int $FirstDeposit 首冲玩家数
 * @property int $SecondDeposit 再冲玩家数
 * @property int $AverageOnline 平均在线人数（小时）
 * @property int $TotalDeposit 总存款
 * @property int $TotalWithdraw 总提款
 * @property int $TotalBonus 总奖金
 * @property int $TotalFee 转账手续费
 * @property int $TotalRake 总税收
 * @property int $UseBonus 消耗奖金数
 */
class DayReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day_report';
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
            [['DayDate'], 'required'],
            [['DayDate'], 'safe'],
            [['NewPlayers', 'FirstDeposit', 'SecondDeposit', 'AverageOnline', 'TotalDeposit', 'TotalWithdraw', 'TotalBonus', 'TotalFee', 'TotalRake', 'UseBonus'], 'integer'],
            [['DayDate'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'DayDate' => '日期',
    'NewPlayers' => '新注册玩家数',
    'FirstDeposit' => '首冲玩家数',
    'SecondDeposit' => '再冲玩家数',
    'AverageOnline' => '平均在线人数（小时）',
    'TotalDeposit' => '总存款',
    'TotalWithdraw' => '总提款',
    'TotalBonus' => '总奖金',
    'TotalFee' => '转账手续费',
    'TotalRake' => '总税收',
    'UseBonus' => '消耗奖金数',
        ];
    }
}
