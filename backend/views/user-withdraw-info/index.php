<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserWithdrawInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Withdraw Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-withdraw-info-index">
    <script>
        var curUid = '';
        /**
         * 更新商户名称
         * @param x
         * @param gid
         */
        function updateName(flag,value)
        {

            $.post("/user-withdraw-info/change-states?id="+value+"&desc=33&value="+flag, function (data){
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
            $.post("/user-withdraw-info/change-states?id="+curUid+"&value=2&desc="+colorTxt.value, function (data){
                alert(data);
                window.location.reload();
            });
        }

    </script>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Please enter the reason for failure and email it to the user</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-refuse" placeholder="cause" maxlength="255" style="width: 100%;height:50px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?=html::button('Confirm', ['class'=>"btn btn-danger", 'onclick'=>'onConfirmHandler()']); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style'=>'overflow:auto'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'UserID',
            'Amount',
            'BeforeScore',
            'Tax',
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Yii::$app->params['withdrawStatusLabels'][$model->Status];
                }
            ],
//            'ClubLV',
            //'OperatorID',
            //'OperatorTime',
            //'WithDrawTime',
            'CreateTime',
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function($model){
                    return html::button('Agree', ['id'=>'btn-agree','class'=>"btn btn-primary", 'onclick'=>'updateName(1,'. $model->ID .')']).
                    html::button('Refuse', ['id'=>'btn-refuse','class'=>"btn btn-danger", 'onclick'=>'onRefuseClick('. $model->ID.')']);
                }
            ],
        ],
    ]); ?>
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
