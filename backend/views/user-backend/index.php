<?php

use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Backends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-index">

<script>
    var curUid = '';

    function onAlertChangePwd(flag){
        curUid = flag;
        $('#changePwdModal').modal('show');
    }
    function onConfirmChangePwdHandler() {
        let txt_1 = document.getElementById('txt-pwd').value;
        if( txt_1.length >= 6 ){
            $.post("/user-backend/changepwd?id="+curUid+"&pwd="+ txt_1, function (data){
                $('#changePwdModal').modal('hide');
                if( data == 1 ){
                    alert("change passwrod sucess!");
                    window.location.reload();
                }else{
                    alert("change passwrod error!");
                }
            });
        }else{
            alert("Password minimum 6 characters!");
        }
    }
</script>
    <p>
        <?= Html::a('Create User Backend', ['signup'], ['class' => 'btn btn-success']) ?>
    </p>
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'is_admin',
            //'created_at',
            //'updated_at',

            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {changepwd} {delete}'),
                'header' => 'Action',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View',$url, [
                            'class' => 'btn btn-default',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Delete',$url, [
                            'class' => 'btn btn-danger',
                            'data-confirm'=>"Are you sure you want to delete this item?",
                            'data-method'=>"post",
                        ]);
                    },
                    'changepwd' => function ($url, $model, $key) {
                        return html::button('ChangePWD', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onAlertChangePwd('. $model->id .')']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
