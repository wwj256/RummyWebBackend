<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_log".
 *
 * 
 * @property int $id
 * @property string $route 路由名
 * @property string $description 描述
 * @property int $created_at 操作时间
 * @property int $user_id 操作ID
 * @property string $user_name 操作ID
 */
class AdminLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at', 'user_id', 'user_name'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['route'], 'string', 'max' => 255],
            [['user_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'id' => 'LogID',
    'route' => '路由名',
    'description' => '描述',
    'created_at' => '操作时间',
    'user_id' => '操作ID',
    'user_name' => '操作ID',
        ];
    }
}
