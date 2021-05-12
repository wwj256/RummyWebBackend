<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserScoreChangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Score Changes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-score-change-index">



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
                <th>ID</th>
                <th>UserID</th>
                <th>NickName</th>
                <th>Type</th>
                <th>Score</th>
                <th>ScoreChange</th>
                <th>Bind</th>
                <th>BindChange</th>
                <th>Bonus</th>
                <th>BonusChange</th>
                <th>Luck</th>
                <th>LuckChange</th>
                <th>RelateID</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['ID']?></td>
                    <td><?=html::a($val['UID'],"/account-info/index?AccountInfoSearch[UserID]={$val['UID']}")?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?= Yii::$app->params['scoreChangeTypes'][$val['SType']] ?></td>
                    <td><?=$val['Score']/100 ?></td>
                    <td><?=$val['SChange']/100 ?></td>
                    <td><?=$val['Bind']/100 ?></td>
                    <td><?=$val['BindChg']/100 ?></td>
                    <td><?=$val['Bonus']/100 ?></td>
                    <td><?=$val['BonusChg']/100 ?></td>
                    <td><?=$val['Luck']/100 ?></td>
                    <td><?=$val['LuckChg']/100 ?></td>
                    <td><?php
                        //1游戏,2支付,3提现,4管理员,5:返拥,6:实名认证,7: 抽奖奖励,8:破产补助
                        $str = "";
                        switch ($val['SType']){
                            case 1:
                                $str = html::a($val['RelateID'],"/game-record/index?GameRecordSearch[RcdId]={$val['RelateID']}");
                                break;
                            case 2:
                                $str = html::a($val['RelateID'],"/user-order-info/index?UserOrderInfoSearch[OrderID]={$val['RelateID']}");
                                break;
                            case 3:
                                $str = html::a($val['RelateID'],"/user-withdraw-info/index?UserWithdrawInfoSearch[ID]={$val['RelateID']}");
                                break;
                            case 4:
                                $str = $val['RelateID'];
                                break;
                        }
                        echo $str;
                        ?>
                    </td>
                    <td><?=$val['UpdateTime']?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'First', 'lastPageLabel' => 'Last', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>
