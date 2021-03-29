<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_record".
 *
 * 
 * @property int $RcdId 记录ID
 * @property int $Turns 轮数
 * @property int $GameId 游戏id
 * @property int $RoomId 房间id
 * @property int $PlyNum 玩家数量
 * @property int $Tax 税收
 * @property int $SysWin 系统输赢
 * @property string $Procedure 过程
 * @property int $TimeCost 消耗时间
 * @property string $BeginTime 开始时间
 */
class GameRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lami_record.game_record';
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
            [['RcdId', 'Turns'], 'required'],
            [['RcdId', 'Turns', 'GameId', 'RoomId', 'PlyNum', 'Tax', 'SysWin', 'TimeCost'], 'integer'],
            [['BeginTime'], 'safe'],
            [['Procedure'], 'string', 'max' => 4096],
            [['RcdId', 'Turns'], 'unique', 'targetAttribute' => ['RcdId', 'Turns']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'RcdId' => '记录ID',
    'Turns' => '轮数',
    'GameId' => '游戏id',
    'RoomId' => '房间id',
    'PlyNum' => '玩家数量',
    'Tax' => '税收',
    'SysWin' => '系统输赢',
    'Procedure' => '过程',
    'TimeCost' => '消耗时间',
    'BeginTime' => '开始时间',
        ];
    }

    /*
     * game_type
     * */
    public function getgame_type()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(GameType::className(), ['GameID' => 'GameId']);
    }
}
