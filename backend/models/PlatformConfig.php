<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "platform_config".
 *
 * 
 * @property string $K
 * @property string $V
 * @property string $info
 */
class PlatformConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'platform_config';
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
            [['K'], 'required'],
            [['K'], 'string', 'max' => 32],
            [['V'], 'string', 'max' => 1024],
            [['info'], 'string', 'max' => 128],
            [['K'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'K' => '',
    'V' => '',
    'info' => '',
        ];
    }
}
