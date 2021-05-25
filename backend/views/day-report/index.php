<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DayReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Day Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-report-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DayDate',
            'NewPlayers',
            'FirstDeposit',
            'SecondDeposit',
            'AverageOnline',
            'TotalDeposit',
            'TotalWithdraw',
            'TotalBonus',
            'TotalFee',
            'TotalRake',
            'UseBonus',
        ],
    ]); ?>


</div>
