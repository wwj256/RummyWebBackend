<?php

use backend\models\UserDeal;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<script>
    function onChangePwdClick() {
        $().openChangePwdModal();
    }

    function onConfirmCPWDHandler() {
        let txt_1 = document.getElementById('txt-pwd1').value;
        if( txt_1.length >= 6 ){
            $().closeChangePwdModal();
            $.post("/deal/change-pwd?pwd="+ txt_1, function (data){
                alert(data?"change password success!":"change password error");
            });
        }else{
            alert("Password should be at least 6 characters!");
        }
        
    }
</script>
<div class="modal fade" id="changePwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" ">Please enter new password!</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="txt-pwd1" placeholder="password" maxlength="9" style="width:100%;;height:50px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?=html::button('Confirm', ['class'=>"btn btn-danger", 'onclick'=>'onConfirmCPWDHandler()']); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">Console</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li >
                    <div style="margin-top: 15px;font-size: 17px;color:white">BlueGem：
                    <?php 
                        echo Yii::$app->user->identity->Score/100;
                    ?></div>
                </li>
                <li class="dropdown user user-menu">
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:''?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= html::button('ChangePasswrod', ['id'=>'btn-refuse','class'=>"btn btn-primary", 'onclick'=>'onChangePwdClick()']);
                                 ?>
                                <?= Html::a(
                                    'Logout',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php // 创建modal

$js = <<<JS
// 创建操作
$(function () {
    $.fn.openChangePwdModal = function(){
        $('#changePwdModal').modal('show');
    }
    $.fn.closeChangePwdModal = function(){
        $('#changePwdModal').modal('hide');
    }
});

JS;

$this->registerJs($js);
?>
