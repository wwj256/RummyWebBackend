<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_type".
 *
 * 
 * @property int $GameID
 * @property string $GameName
 */
class GameType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lami_platform.game_type';
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
            [['GameID'], 'required'],
            [['GameID'], 'integer'],
            [['GameName'], 'string', 'max' => 64],
            [['GameID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'GameID' => 'GameID',
    'GameName' => 'GameName',
        ];
    }
}
