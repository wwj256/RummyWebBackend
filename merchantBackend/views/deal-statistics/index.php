<?php
/* @var $this yii\web\View */
$this->title = 'Statstics';
?>
<script>
    function toDealOut(){
        window.location.href = '/deal-out/index';
    }
    function toDealIn(){
        window.location.href = '/deal-in/index';
    }
</script>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange" >
            <div class="inner">
                <h3><?php
                    echo $homeData['sellCount'] ? abs($homeData['sellCount'])/100 : 0;
                    ?></h3>
                <p onclick="toDealOut()">Total Tokens Sold</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6" >
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
                    echo $homeData['buyCount'] ? $homeData['buyCount']/100 : 0;
                    ?></h3>
                <p onclick="toDealIn()">Total Tokens Redeemed</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?php
                    echo $homeData['curCount'] ? $homeData['curCount']/100 : 0;
                    ?></h3>
                <p>Total App-Wide Token Balance</p>
            </div>
        </div>
    </div>
</div>
<div class="good-type-order-box">
    <div >Last 30 Days</div>
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
                label: 'Tokens Sold',
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
            // responsive: false,
            maintainAspectRatio: false
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
                label: 'Tokens Redeemed',
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
            // responsive: false,
            maintainAspectRatio: false
        }
    });

</script>
