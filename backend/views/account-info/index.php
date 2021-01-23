<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-info-index">
    <script>
        /**
         * 更新订单状态
         * @param x
         * @param gid
         */
        function updateStatus(state, uid)
        {
            $.post("/account-info/update-state?id="+uid+"&status="+state.selectedIndex,function (data){
                alert(data)
            });
        }

        var curUid = '';
        function onRefuseClick(flag) {
            curUid = flag;
            $().openModal();
        }

        function onConfirmHandler() {
            let desc = document.getElementById('txt-refuse');
            let txt_1 = document.getElementById('txt-1').value;
            let txt_2 = document.getElementById('txt-2').value;
            let txt_3 = document.getElementById('txt-3').value;
            let txt_4 = document.getElementById('txt-4').value;
            let txt_5 = document.getElementById('txt-5').value;
            $().closeModal();
            console.log("/account-info/add-score?id="+curUid+"&SChange="+ txt_1+"&BindChg="+ txt_2+"&BonusChg="+ txt_3 +"&LuckChg="+ txt_4 +"&desc="+desc.value);
            $.post("/account-info/add-score?id="+curUid+"&SChange="+ txt_1+"&BindChg="+ txt_2+"&BonusChg="+ txt_3 +"&LuckChg="+ txt_4 +"&ExpScore="+ txt_5 +"&desc="+desc.value, function (data){
                alert(data);
                window.location.reload();
            });
        }

        function onChangeStateClick(flag) {
            curUid = flag;
            $().openModal();
        }

        function exportData(x, dsn)
        {
            $.post("/account-info/export",function (data){
                // if( data == '修改成功'){
                //     x.disabled='true';
                // }
                alert(data);
            });
        }

    </script>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">请输入所要加的分数</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-1" placeholder="Score" maxlength="255" style="width:100%;;height:50px">
                    <input type="text" id="txt-2" placeholder="BindScore" maxlength="255" style="width: 100%;height:50px">
                    <input type="text" id="txt-3" placeholder="BonusScore" maxlength="255" style="width: 100%;height:50px">
                    <input type="text" id="txt-4" placeholder="LuckScore" maxlength="255" style="width: 100%;height:50px">
                    <!-- <input type="text" id="txt-5" placeholder="ExpScore" maxlength="255" style="width: 100%;height:50px"> -->
                    <input type="text" id="txt-refuse" placeholder="原因" maxlength="255" style="width: 100%;height:50px">
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
                <th>UserID</th>
                <th>NickName</th>
                <th>Total Rechage</th>
                <th>Total Score</th>
                <th>BindScore</th>
                <th>BonusScore</th>
                <th>LuckScore</th>
                <th>ExpScore</th>
                <th>SpreadID</th>
                <th>Status</th>
                <th>LoginDate</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['UserID']?>">
                    <td><?=$val['UserID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?php
                        $statisticsSql = "SELECT SUM(Amount) as Amount FROM user_order_info WHERE UserID = {$val['UserID']} and (`Status` = 1 or `Status` =3);";
                        $tModel = Yii::$app->db2->createCommand($statisticsSql)
                            ->queryOne();
                        echo $tModel['Amount']? $tModel['Amount']/100 : '0';
                        ?>
                    </td>
                    <td><?=$val['Score']/100 ?></td>
                    <td><?=$val['BindScore']/100 ?></td>
                    <td><?=$val['BonusScore']/100 ?></td>
                    <td><?=$val['LuckScore']/100 ?></td>
                    <td><?=$val['ExpScore']/100 ?></td>
                    <td><?=$val['SpreadID'] ?></td>
                    <td><?=Html::dropDownList('isBrand', $val['Status'], [0=>'正常',1=>'禁止游戏和提现',2=>'禁止登录'], ['style'=>'width:100px', 'onchange'=>'
                        updateStatus(this,'. $val['UserID'].')'
                        ]); ?></td>
                    <td><?=$val['LoginDate'] ?></td>
                    <td><?php
                        echo html::button('addScore', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onRefuseClick('. $val['UserID'] .')']);
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
