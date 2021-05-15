<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_config".
 *
 * 
 * @property string $K 键
 * @property string $V 值
 * @property string $Info 描述
 */
class SysConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_config';
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
            [['K'], 'required'],
            [['K'], 'string', 'max' => 64],
            [['V'], 'string', 'max' => 128],
            [['Info'], 'string', 'max' => 512],
            [['K'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'K' => 'Key',
    'V' => 'Value',
    'Info' => 'Desc',
        ];
    }
}
