<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserDealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Deals');
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    var curUid = '';
    function onRefuseClick(flag) {
        curUid = flag;
        $().openModal();
    }

    function onConfirmHandler() {
        let txt_1 = parseFloat(document.getElementById('txt-1').value);
        if( txt_1 ){
            $().closeModal();
            console.log("/user-deal/add-score?id="+curUid+"&SChange="+ txt_1);
            $.post("/user-deal/add-score?id="+curUid+"&SChange="+ txt_1, function (data){
                alert(data);
                window.location.reload();
            });
        }else{
            alert("Please enter the correct number!");
        }
    }

    function onAlertChangePwd(flag){
        curUid = flag;
        $('#changePwdModal').modal('show');
    }
    function onConfirmChangePwdHandler() {
        let txt_1 = document.getElementById('txt-pwd').value;
        if( txt_1.length >= 6 ){
            console.log("/user-deal/changepwd?id="+curUid+"&SChange="+ txt_1);
            $.post("/user-deal/changepwd?id="+curUid+"&pwd="+ txt_1, function (data){
                $('#changePwdModal').modal('hide');
                alert(data);
                window.location.reload();
            });
        }else{
            alert("Password minimum 6 characters!");
        }
        
    }
</script>
<div class="user-deal-index">

    <p>
        <?= Html::a(Yii::t('app', 'Add User Deal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Please enter the number of points you want to add!</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-1" placeholder="Score" maxlength="255" style="width:100%;;height:50px" oninput = "value=value.replace(/[^\d]/g,'')">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?=html::button('Confirm', ['class'=>"btn btn-danger", 'onclick'=>'onConfirmHandler()']); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <div class="modal fade" id="changePwdModal" tabindex="-1" role="dialog" aria-labelledby="changePwdModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="changePwdModalLabel">Please enter a new password!</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="txt-pwd" placeholder="new password" maxlength="12" minlength="6" style="width:100%;;height:50px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?=html::button('Confirm', ['class'=>"btn btn-danger", 'onclick'=>'onConfirmChangePwdHandler()']); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <?php
        $buttons = [];
        if( $isAdmin ){
            $buttons = [
                'addscore' => function ($url, $model, $key) {
                    return html::button('addScore', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onRefuseClick('. $model->UserID .')']);
                },
                'changepwd' => function ($url, $model, $key) {
                    return html::button('ChangePWD', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onAlertChangePwd('. $model->UserID .')']);
                },
            ];
        };
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UserID',
            'Password',
            'Phone',
            [
                'attribute' => 'Score',
                'format' => 'raw',
                'value' => function($model){
                    return $model->Score/100;
                }
            ],
            'CreateDate',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{addscore} {changepwd}'),
                'header' => 'Action',
                'buttons' => $buttons,
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
