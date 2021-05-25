<?php
/* @var $this yii\web\View */
// $this->title = 'Statistics info';
$this->title = '';
?>
<section class="content-header">
    <h1>
    Statistics Data           </h1>
    <p/>
</section>
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
                    echo $homeData['TotalDepositors']>0 ? $homeData['TotalDepositors']/100 : '0';
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
                    echo $homeData['TotalRake']/100;
                    ?></h3>
                <p>Total Rake</p>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <h1>
    Nearly a month data            </h1>
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
    
</div>
<section class="content-header">
    <h1>
    Current month data            </h1>
    <p/>
</section>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
                    echo $homeData['CurrentMontyNewRegistrations'];
                    ?></h3>
                <p>CurrentMontyNewRegistrations</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
                    echo $homeData['CurrentMontyFTD'];
                    ?></h3>
                <p>CurrentMontyFTD</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
                    echo $homeData['CurrentMontyTotalDepositors']>0 ? $homeData['CurrentMontyTotalDepositors']/100 : '0';
                    ?></h3>
                <p>CurrentMontyTotalDepositors</p>
            </div>
        </div>
    </div>
</div>