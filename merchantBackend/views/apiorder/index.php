<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ApiorderSearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商户订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apiorder-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'oid',
//            'uid',
//            'app_key',
            'payuid',
            [
                "attribute"=>'ostate',
                'format'=>'raw',
                'headerOptions' => ['width' => '7%'],
                'value'=>function($m){
                    return $m->ostate == 1 ? "已支付":"未支付";
                },
            ],
            //'order_id',
            //'amount_type',
            [
                "attribute"=>'amount',
                'format'=>'raw',
                'headerOptions' => ['width' => '7%'],
                'value'=>function($m){
                    return $m->amount;
//                    return \common\components\GFTool::fenToYuan($m->amount);
                },
            ],
            [
                "attribute"=>'order_fee',
                'format'=>'raw',
                'headerOptions' => ['width' => '7%'],
                'value'=>function($m){
                    return $m->order_fee;
//                    return \common\components\GFTool::fenToYuan($m->order_fee);
                },
            ],
            'body',
            'return_url:url',
            'notify_url:url',
            'clienttime',
            'order_ip',
            //'extra',
            //'lang',
            'createtime',
            //'updatetime',
        ],
    ]); ?>


</div>
