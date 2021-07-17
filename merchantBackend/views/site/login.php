<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Merchant Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon  form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon  form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class=' form-control-feedback'></span>"
];

?>
<style>
    .codeBtn {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        display: block;
        width: 50px;
        height: 34px;
        line-height: 30px;
        text-align: center;
    }
</style>
<script>
    var serverUrl = "<?= Yii::$app->params['APIUrl']?>"
    function onSendSMS()
    {
        let txt_1 = document.getElementById('loginformmerchant-username').value;
        if( txt_1.length < 3 ){
            alert("Please input the correct mobile phone number!");
            return;
        }
        $.post("/site/sendsms?phone="+txt_1, function (data){
            if( data == "1" ){
                alert("SMS verification code sent successfully, please contact with the other party！");
            }else{
                alert(data);
            }
            // window.location.reload();
        });
    };
    function btnSearchHandler()
    {
        let txt_1 = parseInt(document.getElementById('targetID').value);
        if( !txt_1  ){
            alert("Please enter the correct user ID");
            return;
        }
        $.post("/deal/search-info?id="+txt_1, function (data){
            data = JSON.parse(data);
            if( data && data['NickName'] ){
                document.getElementById('targetName').value = data['NickName'];
                document.getElementById('targetScore').value = data['Score']/100;
                $("#targetInfo").show();
            }else{
                alert("User not found, please re-enter user ID");
            }
            // window.location.reload();
        });
    };
    //交易货币，type，0:转入，1:转出
    function btnDealHandler(type)
    {
        let txt_1 = document.getElementById('targetID').value;
        let txt_2 = document.getElementById('dealCount').value;
        let txt_3 = document.getElementById('targetPhone').value;
        let txt_4 = document.getElementById('targetCode').value;
        $.post("/deal/deal?targetID="+txt_1+"&score="+ txt_2+"&phone="+ txt_3 +"&code="+ txt_4 + "&type=" + type, function (data){
            if( data == '1' ){
                alert('Deal success!');
            }else{
                alert(data);
            }
            // window.location.reload();
        });
        if( type == 0 ){

        }else{

        }
    }
</script>

<div class="login-box" style="width: 500px;text-align: center;">
    <div class="login-logo" >
        <a href="#"><b>Rummy management system</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="width: 360px;display: inline-block;">
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'Please enter a user phone']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => 'Please enter your password']) ?>

        <div class="form-group has-feedback field-loginformmerchant-code <?= $model->getFirstError('code') ? 'has-error' : "" ?>">
            <input type="txt" id="loginformmerchant-code" style="width: 100%;" class="form-control" name="LoginFormMerchant[code]" placeholder="Verification Code" value="<?= $model->code ?>" oninput = "value=value.replace(/[^\d]/g,'')">
            <button type="button" onclick="onSendSMS()" class="codeBtn">Send</button>
            <p class="help-block help-block-error"><?= $model->getFirstError('code') ?></p>
        </div>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
