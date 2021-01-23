<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_stat_info".
 *
 * 
 * @property int $UserID
 * @property int $TPayScore 总充值金额
 * @property int $TPayCnt 充值次数
 * @property int $TDrawScore 总提现金额
 * @property int $TDrawCnt 总提现次数
 * @property int $TGameCnt 总游戏局数
 * @property int $TBrokeUp 总破产次数
 * @property int $TWinScore 总赢分数
 * @property int $TLostScore 总输分数
 * @property int $TPointCnt
 * @property int $TPoolCnt
 * @property int $TDealCnt
 * @property int $TPoint10Cnt
 * @property int $TMatchCnt
 * @property int $TTicketScore 门票分数
 * @property int $TAssistScore 救助分数
 * @property int $TInviteScore 邀请获得分数
 */
class UserStatInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_stat_info';
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
            [['UserID'], 'required'],
            [['UserID', 'TPayScore', 'TPayCnt', 'TDrawScore', 'TDrawCnt', 'TGameCnt', 'TBrokeUp', 'TWinScore', 'TLostScore', 'TPointCnt', 'TPoolCnt', 'TDealCnt', 'TPoint10Cnt', 'TMatchCnt', 'TTicketScore', 'TAssistScore', 'TInviteScore'], 'integer'],
            [['UserID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UserID' => '',
    'TPayScore' => '总充值金额',
    'TPayCnt' => '充值次数',
    'TDrawScore' => '总提现金额',
    'TDrawCnt' => '总提现次数',
    'TGameCnt' => '总游戏局数',
    'TBrokeUp' => '总破产次数',
    'TWinScore' => '总赢分数',
    'TLostScore' => '总输分数',
    'TPointCnt' => '',
    'TPoolCnt' => '',
    'TDealCnt' => '',
    'TPoint10Cnt' => '',
    'TMatchCnt' => '',
    'TTicketScore' => '门票分数',
    'TAssistScore' => '救助分数',
    'TInviteScore' => '邀请获得分数',
        ];
    }
}
