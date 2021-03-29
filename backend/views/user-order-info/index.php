<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserOrderInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Order Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-info-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'OrderID',
            'UserID',
//            'NickName',
            [
                'attribute' => 'NickName',
                'format' => 'raw',
                'value' => function($model){
//                    Yii::warning('$model='.json_encode($model->NickName));
                    $tModel = \backend\models\AccountInfo::find()->select('NickName')->where('UserID='.$model->UserID)->one();
                    if( !$tModel ) return '';
                    return $tModel->NickName;
                }
            ],
            'CreateTime',
            'SpreadID',
            'ScoreAmount',
            'Amount',
            [
                'attribute' => 'CouponID',
                'format' => 'raw',
                'value' => function($model){
                    return html::a($model->CouponID,"/user-coupon-info/index?UserCouponInfoSearch[ID]={$model->CouponID}");
                }
            ],
            [
                'attribute' => '赠送金额',
                'format' => 'raw',
                'value' => function($model){
                    return ($model->ScoreAmount - $model->Amount)/100;
                }
            ],
            'UserEndScore',
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Yii::$app->params['orderInfoStatusLabels'][$model->Status];
                }
            ],
            'ReferenceId',
            'PaymentMode',
            'PayTime',




        ],
    ]); ?>
</div>
