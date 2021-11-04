<?php
/* @var $this yii\web\View */
$this->title = '';
?>
<style>
    .leftLabel {
        width: 70px;
        display: inline-block;
    }
    .formItem {
        display: block;
        margin: 5px 0px;
    }
</style>
<script>
    var serverUrl = "<?= Yii::$app->params['APIUrl']?>"
    function onSendSMS()
    {
        let txt_1 = document.getElementById('targetPhone').value;
        if( txt_1 == "" ){
            alert("If no mobile phone number is bound to the user, bind the mobile phone number!");
            return;
        }
        $.post("/deal/sendsms?phone="+encodeURIComponent(txt_1), function (data){
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
                document.getElementById('targetScore').value = (data['Score'] - data['BindScore'])/100;
                document.getElementById('targetBindScore').value = data['BindScore']/100;
                document.getElementById('targetPhone').value = data['Phone'];
                $("#targetInfo").show();
            }else{
                alert("User not found, please re-enter user ID");
            }
            // window.location.reload();
        });
    };
    //交易货币，type，0:扣除用户金币，1:转给用户金币
    function btnDealHandler(type)
    {
        let txt_1 = document.getElementById('targetID').value;
        let txt_2 = document.getElementById('dealCount').value;
        let txt_3 = document.getElementById('targetPhone').value;
        let txt_4 = document.getElementById('targetCode').value;
        txt_3 = encodeURIComponent(txt_3);
        if( txt_2 < <?= $tradeUserMinScore/100 ?> ){
            alert("Withdrawal can not be less than <?= $tradeUserMinScore/100 ?> bluegems, binding limit can not be withdrawn");
            return;
        }
        if( type == 0 ){
            if( txt_4 == "" ){
                alert("Please enter the OPT,If no mobile phone number is bound to the user, bind the mobile phone number!");
                return;
            }
        }else{

        }
        $.post("/deal/deal?targetID="+txt_1+"&score="+ txt_2+"&phone="+ txt_3 +"&code="+ txt_4 + "&type=" + type, function (data){
            if( data == '1' ){
                document.getElementById('targetCode').value = "";
                alert('Deal success!');
            }else{
                alert(data);
            }
            // window.location.reload();
        });
        
    }
</script>
<span style="font-size: 25px;">Transaction Operations Portal</span>
<div style="width: 100%;overflow: auto;" >
    <div style="display: flex;flex-direction:column;width: 850px;margin-top:15px;">
    <div class="formItem">
        <span class="leftLabel" >User ID:</span>
        <input type="text" id="targetID" placeholder="Game ID" oninput = "value=value.replace(/[^\d]/g,'')" >
        <button type="button" onclick="btnSearchHandler()" ><span class="glyphicon glyphicon-search"></span></button>
        <span id="error_id" style="color: #000000;">The user's game ID</span>
    </div>
    <div class="formItem" id="targetInfo" style="display: none;">
        <span class="leftLabel" >NickName:</span>
        <input type="text" id="targetName"  >
        <span class="leftLabel" >BlueGems:</span>
        <input type="text" id="targetScore"  >
        <span class="leftLabel" style="width: 100px;">BindBlueGems:</span>
        <input type="text" id="targetBindScore"  >
    </div>
    <div class="formItem">
        <span class="leftLabel" >DealScore:</span>
        <input type="text" id="dealCount" placeholder="Transaction amount" oninput = "value=value.replace(/[^\d]/g,'')">
        <span id="error_phone" style="color: #000000;">Withdrawal can not be less than <?= $tradeUserMinScore/100 ?> bluegems, binding limit can not be withdrawn</span>
    </div>
    <div class="formItem">
        <span class="leftLabel">Mobile #:</span>
        <input type="text" id="targetPhone" placeholder="Mobile phone no." oninput = "value=value.replace(/[^\d]/g,'')" disabled="disabled">
        <span id="error_phone" style="color: #000000;">User's Linked Mobile #</span>
    </div>
    <div class="formItem">
        <span class="leftLabel">OTP:</span>
        <input type="text" id="targetCode" placeholder="The verification code received by the counterparty" >
        <button type="button" onclick="onSendSMS()" class="btn btn-primary">Send OTP</button>
        <span id="error_code" style="color: #000000;">User's OTP</span>
    </div>
    <div class="formItem" style="display: flex;justify-content:center;width:600px;">
        <button type="button" onclick="btnDealHandler(0)" class="btn btn-primary">Deduct Tokens</button>
        <button type="button" onclick='btnDealHandler(1)' class="btn btn-primary" style="margin-left: 100px;">Recharge Tokens</button>
    </div>
    <div class="formItem" style="width:700px;">
        <span style="display:block;text-align:center">Note: Mobile Number/OTP is not needed for recharges</span>
    </div>
</div>
</div>
