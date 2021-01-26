<?php

use backend\models\UserInviteStat;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserRealInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'KYC核审列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-real-info-index">
    <script>
        var curUid = '';
        /**
         * 更新商户名称
         * @param x
         * @param gid
         */
        function updateName(flag,value)
        {

            $.post("/user-real-info/change-states?id="+value+"&desc=&value="+flag, function (data){
                alert(data);
                window.location.reload();
            });
            // $.post("/acctemail/add-mail?id="+value+"&content=33&title="+flag, function (data){alert(data)});
        }

        function onRefuseClick(flag) {
            curUid = flag;
            $().openModal();
        }

        function onConfirmHandler() {
            let colorTxt = document.getElementById('txt-refuse');
            $().closeModal();
            $.post("/user-real-info/change-states?id="+curUid+"&value=3&desc="+colorTxt.value, function (data){
                alert(data);
                window.location.reload();
            });
        }

    </script>
    <?php
//        $todayStr = date("Y-m-d");
//        $inviteStatModel = UserInviteStat::findOne(['UID' => 99, 'DayStat' => $todayStr]);
//        $inviteStatModel = new UserInviteStat();
//        $inviteStatModel->loadDefaultValues();
//        $inviteStatModel->UID = 9999;
//        $inviteStatModel->DayStat = $todayStr;
//        $inviteStatModel->TotalBonus = $inviteStatModel->TotalBonus + 20;
//        $inviteStatModel->InviteBonus = $inviteStatModel->InviteBonus + 20;
//        echo $inviteStatModel->TotalBonus.'result='.$inviteStatModel->save();
    ?>

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
        <?php 
            $count = count($model);
            $totalCount = $pages->totalCount;
            $begin = $pages->getPage() * $pages->getPageSize() + 1;
            $end = $begin + $count - 1;
            if ($begin > $end) {
                $begin = $end;
            }          
            echo Html::tag($tag, Yii::t('yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.', [
                    'begin' => $begin,
                    'end' => $end,
                    'count' => $count,
                    'totalCount' => $totalCount,
                ]));            
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>用户ID</th>
                <th>昵称</th>
                <th>证件类型</th>
                <th>正面</th>
                <th>背面</th>
                <th>姓名</th>
                <th>证件号码</th>
                <th>出生日期</th>
                <th>地址</th>
                <th>审核状态</th>
                <th>提交时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['UserID']?>">
                    <td><?=$val['UserID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?= Yii::$app->params['identityCardTypes'][$val['Type']] ?></td>
                    <td><?= "<img src="?> <?= Yii::$app->params['APIUrl']."image/download?url=". $val['FrontUrl']." style='width:200px'>";?></td>
                    <td><?= "<img src="?> <?= Yii::$app->params['APIUrl']."image/download?url=". $val['BackUrl']." style='width:200px'>";?></td>
                    <td><?=$val['Name']?></td>
                    <td><?=$val['CardID']?></td>
                    <td><?=$val['Birth']?></td>
                    <td><?=$val['Address']?></td>
                    <td><?= Yii::$app->params['realInfoStatus'][$val['Status']] ?></td>
                    <td><?=$val['RecordTime']?></td>
                    <td ><?php
                        if( $val['Status'] == 1 ){
                            echo html::button('同意', ['class'=>"btn btn-danger", 'onclick'=>'updateName(2,'. $val['UserID'] .')']);
                            echo html::button('拒绝', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onRefuseClick('. $val['UserID'] .')']);
                        }
                        ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>
<?php // 创建modal

$js = <<<JS
// 创建操作
$(function () {
    $.fn.openModal = function(){
        $('#myModal').modal('show');
    }
    $.fn.closeModal = function(){
        $('#myModal').modal('hide');
    }
});

JS;

$this->registerJs($js);
?>