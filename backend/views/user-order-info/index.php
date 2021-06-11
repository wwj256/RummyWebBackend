<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserOrderInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Order Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-info-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <?php 
            $count = count($model);
            $totalCount = $pages->totalCount;
            $begin = $pages->getPage() * $pages->getPageSize() + 1;
            $end = $begin + $count - 1;
            if ($begin > $end) {
                $begin = $end;
            }          
            echo "Showing <b>$begin-$end</b> of <b>$totalCount</b> items.";                
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>OrderID</th>
                <th>UserID</th>
                <th>NickName</th>
                <th>LoginIP</th>
                <th>Phone</th>
                <th>Mail</th>
                <th>CreateTime</th>
                <th>SpreadID</th>
                <th>ActualAmount</th>
                <th>PayAmount</th>
                <th>CouponID</th>
                <th>UserEndScore</th>
                <th>Status</th>
                <th>ReferenceID</th>
                <th>PaymentMode</th>
                <th>PayTime</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['OrderID']?></td>
                    <td><?=$val['UserID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?=$val['LoginIP']?></td>
                    <td><?=$val['Phone']?></td>
                    <td><?=$val['Mail']?></td>
                    <td><?=$val['CreateTime']?></td>
                    <td><?=$val['SpreadID']?></td>
                    <td><?=$val['ScoreAmount']/100 ?></td>
                    <td><?=$val['Amount']/100 ?></td>
                    <td><?=$val['CouponID']==0?'':html::a($val['CouponID'],"/user-coupon-info/index?UserCouponInfoSearch[ID]={$val['CouponID']}") ?></td>
                    <td><?=$val['UserEndScore']/100 ?></td>
                    <td><?=Yii::$app->params['orderInfoStatusLabels'][$val['Status']] ?></td>
                    <td><?=$val['ReferenceId'] ?></td>
                    <td><?=$val['PaymentMode'] ?></td>
                    <td><?=$val['PayTime'] ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'first', 'lastPageLabel' => 'last', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>
