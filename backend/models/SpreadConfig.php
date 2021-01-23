<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spread_config".
 *
 * 
 * @property int $ID
 * @property int $SpreadID 渠道号
 * @property string $RegVersion 适配版本号
 * @property string $ApkUrl 强更地址
 * @property string $HotUrl 热更地址
 * @property string $PageUrl 手动更新地址
 * @property string $Notice 公告
 * @property string $CurVersion 更到哪个版本
 * @property int $UpdateMode 更新方式 0不更新、1非强制更新、2强制更新
 * @property string $ApkVersion 强更版本号
 * @property string $PacketUrl 包更地址
 * @property string $Conf 开关配置json
 */
class SpreadConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spread_config';
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
            [['SpreadID', 'UpdateMode'], 'integer'],
            [['PageUrl', 'CurVersion', 'UpdateMode', 'ApkVersion', 'PacketUrl'], 'required'],
            [['RegVersion', 'ApkUrl', 'HotUrl', 'PageUrl', 'Notice', 'CurVersion', 'ApkVersion', 'PacketUrl','Conf'], 'string', 'max' => 255],
            [['SpreadID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'ID' => 'ConfigID',
    'SpreadID' => 'SpreadID',
    'RegVersion' => '适配版本号',
    'ApkUrl' => 'ApkUrl',//强更地址
    'HotUrl' => 'HotUrl',
    'PageUrl' => '手动更新地址',
    'PacketUrl' => 'PacketUrl',//包更地址
    'Notice' => 'Notice',//公告
    'CurVersion' => 'CurrentVersion',//更到哪个版本
    'UpdateMode' => 'UpdateMode',//更新方式 0不更新、1非强制更新、2强制更新
    'ApkVersion' => '强更版本号',
    'Conf' => 'Config',//配置JSON
        ];
    }
}
