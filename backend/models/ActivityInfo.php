<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "activity_info".
 *
 * 
 * @property int $ID
 * @property string $Tiltle 展示标题
 * @property string $Url 图片地址 活动必填
 * @property string $JumpTo 跳转地址编号
 * @property string $StartTime 开始时间 活动必填
 * @property string $EndTime 结束时间 活动必填
 */
class ActivityInfo extends \yii\db\ActiveRecord
{
    public $imageUrl;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity_info';
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
            [['Url', 'JumpTo', 'StartTime', 'EndTime'], 'required'],
            [['Url','JumpTo'], 'string'],
            [['StartTime', 'EndTime'], 'safe'],
            [['Tiltle'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',//活动ID
            'Tiltle' => 'Tiltle',//展示标题
            'Url' => 'Url',//图片地址 活动必填
            'JumpTo' => 'JumpTo',//跳转地址编号 
            'StartTime' => 'StartTime',//开始时间 活动必填
            'EndTime' => 'EndTime',//结束时间 活动必填
        ];
    }
}
