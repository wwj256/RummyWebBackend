<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "robot_config".
 *
 * 
 * @property int $UID bind用户ID
 * @property int $SrvID 被使用服务器ID
 */
class RobotConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'robot_config';
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
            [['UID'], 'required'],
            [['UID', 'SrvID'], 'integer'],
            [['UID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UID' => 'bind用户ID',
    'SrvID' => '被使用服务器ID',
        ];
    }
}
