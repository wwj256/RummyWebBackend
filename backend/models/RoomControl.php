<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "room_control".
 *
 * 
 * @property int $RoomID
 * @property int $MinScore
 * @property int $Score
 * @property int $MaxScore
 * @property int $Ticket    门票次数
 * @property int $FeeTicket 支付金币门票次数
 * @property int $WinInterval   玩家赢的间隔
 */
class RoomControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_control';
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
            [['RoomID'], 'required'],
            [['RoomID', 'MinScore', 'Score', 'MaxScore','Ticket','FeeTicket','WinInterval'], 'integer'],
            [['RoomID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'RoomID' => 'RoomID',
    'MinScore' => 'MinScore',
    'Score' => 'Score',
    'MaxScore' => 'MaxScore',
    'Ticket' => 'Ticket',//门票次数
    'FeeTicket' => 'FeeTicket',//支付金币门票次数
    'WinInterval' => 'WinInterval',//玩家赢的间隔
        ];
    }
}
