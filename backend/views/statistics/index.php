<?php
/* @var $this yii\web\View */
$this->title = 'Statistics info';
?>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php
                    echo $homeData['allRegisterCount'];
                    ?></h3>
                <p>Total Regstered Players</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php
                    echo $homeData['TotalDepositors']>0 ? $homeData['TotalDepositors'] : '0';
                    ?></h3>
                <p>Total Depositors</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php
                    echo $homeData['TotalRake'];
                    ?></h3>
                <p>Total Rake</p>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <h1>
        今日信息            </h1>
    <p/>
</section>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php
                    echo $homeData['ActiveRealPlayers'];
                    ?></h3>
                <p>ActiveRealPlayers</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php
                    echo $homeData['ActiveDepositingPlayers'];
                    ?></h3>
                <p>ActiveDepositingPlayers</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php
                    echo $homeData['NewRegistrations'];
                    ?></h3>
                <p>NewRegistrations</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php
                    echo $homeData['CurrentMontyTotalDepositors']>0 ? $homeData['CurrentMontyTotalDepositors'] : '0';
                    ?></h3>
                <p>CurrentMontyTotalDepositors</p>
            </div>
        </div>
    </div>
</div>