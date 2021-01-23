<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_room".
 *
 * 
 * @property int $RoomID RoomID
 * @property int $GameID
* @property int $RealGameID gameid=110 时，代表真实的gameID
* @property int $HaveRbt 房间机器人开启状态 0:关闭，1:开启
* @property int $ActivPlayer 模拟显示的玩家数量
* @property int $RoomStatus 房间开启状态 0:关闭，1:开启，
 * @property int $MainSrvId
 * @property int $SubSrvId
 * @property string $ConfJson
 * @property string $UpdateTime
 */
class GameRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_room';
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
            [['GameID', 'RealGameID', 'HaveRbt', 'ActivPlayer', 'RoomStatus', 'MainSrvId', 'SubSrvId'], 'integer'],
            [['UpdateTime'], 'safe'],
            [['ConfJson'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'RoomID' => 'RoomID',
    'GameID' => 'GameID',
    'RealGameID' => 'gameid=110 时，代表真实的gameID',
    'HaveRbt' => '房间机器人开启状态 0:关闭，1:开启',
    'ActivPlayer' => '模拟显示的玩家数量',
    'RoomStatus' => '房间开启状态 0:关闭，1:开启，',
    'MainSrvId' => 'MainSrvId',
    'SubSrvId' => 'SubSrvId',
    'ConfJson' => 'ConfJson',
    'UpdateTime' => 'UpdateTime',
        ];
    }

    /*
     * room_control
     * */
    public function getroom_control()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(RoomControl::className(), ['RoomID' => 'RoomID']);
    }
}
