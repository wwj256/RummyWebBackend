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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">请输入不通过原因，将以邮件形式发给用户</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-refuse" placeholder="不通过原因" maxlength="255" style="width: 100%;height:50px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <?=html::button('确定', ['class'=>"btn btn-danger", 'onclick'=>'onConfirmHandler()']); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>UserID</th>
                <th>NickName</th>
                <th>Type</th>
                <th>变化前金币</th>
                <th>变化量</th>
                <th>原绑定金币</th>
                <th>绑定金币变化量</th>
                <th>原赠送金币</th>
                <th>赠送金币变化量</th>
                <th>原幸运金币</th>
                <th>幸运金币变化量</th>
                <th>关联ID</th>
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
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>
