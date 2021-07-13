<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = '统计信息';
?>
<script>
    function toDealOut(){
        // window.location.href = '/deal-out/index';
    }
    function toDealIn(){
        // window.location.href = '/deal-in/index';
    }

    function btnSearch(){
        let txt_1 = document.getElementById('userIDTxt').value;
        window.location.href = '/trade-statistics/index?id=' + txt_1;
    }
</script>
<div class="form-group ">
    <label class="form-label" style="width:auto;margin-left:10px" >币商ID</label>
    <input type="text" id="userIDTxt" oninput = "value=value.replace(/[^\d]/g,'')" value="<?= $homeData['userID'] ?>" >
    <button type="button" onclick="btnSearch()" class="btn btn-primary">Search</button>
    <label id="errorLabel" class="form-label" style="width:auto;margin-left:10px;color:#f00;" ><?=  $homeData['error'] ?></label>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange" onclick="toDealOut()">
            <div class="inner">
                <h3><?php
                    echo $homeData['sellCount'] ? abs($homeData['sellCount'])/100 : 0;
                    ?></h3>
                <p>累计转入给用户金币</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6" onclick="toDealIn()">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
                    echo $homeData['buyCount'] ? $homeData['buyCount']/100 : 0;
                    ?></h3>
                <p>累计扣除用户金币</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6" onclick="toDealIn()">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?php
                    echo $homeData['curCount'] ? $homeData['curCount']/100 : 0;
                    ?></h3>
                <p>当前剩余金币</p>
            </div>
        </div>
    </div>
</div>
<div class="good-type-order-box">
    <div >近30日统计</div>
    <div id="container" >
        <canvas id="chatDealOut" ></canvas>
    </div>
    <div id="container" >
        <canvas id="chatDealIn" ></canvas>
    </div>
</div>

<script>
    var chatLabels = <?= $chatLabels ?>;
    var chatDatasIn = <?= $chatDatasIn ?>;
    var chatDatasOut = <?= $chatDatasOut ?>;

    // print(json_decode(chatDatasOut));

    var chatDatas = [];

    var ctx = document.getElementById('chatDealOut').getContext('2d');
    // ctx.canvas.width = 1100;
    ctx.canvas.height = 400;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chatLabels,
        
            datasets: [{
                label: '卖出金币',
                data: chatDatasOut,
                backgroundColor: '#FF851B',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            // responsive: false,//当其容器执行时调整图表画布的大小
            maintainAspectRatio: false//调整大小时保持原始画布纵横比。
        }
    });
    chatDatas = [];

    var ctx = document.getElementById('chatDealIn').getContext('2d');
    // ctx.canvas.width = 1100;
    ctx.canvas.height = 400;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chatLabels,
        
            datasets: [{
                label: '买入金币',
                data: chatDatasIn,
                backgroundColor: '#00a65a',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            // responsive: false,//当其容器执行时调整图表画布的大小
            maintainAspectRatio: false//调整大小时保持原始画布纵横比。
        }
    });

</script>
