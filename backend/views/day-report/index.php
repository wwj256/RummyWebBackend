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
            'OnlinePlayers',
            'GamePlayers',
            'GameInnings',
            [
                'attribute' => 'TotalDeposit',
                'format' => 'raw',
                'value' => function($model){
                    return $model->TotalDeposit/100;
                }
            ],
            [
                'attribute' => 'TotalWithdraw',
                'format' => 'raw',
                'value' => function($model){
                    return $model->TotalWithdraw/100;
                }
            ],
            [
                'attribute' => 'TotalBonus',
                'format' => 'raw',
                'value' => function($model){
                    return $model->TotalBonus/100;
                }
            ],
            'TotalFee',
            [
                'attribute' => Yii::t('app','BackCash'),
                'format' => 'raw',
                'value' => function($model){
                    return ($model->TotalDeposit - $model->TotalWithdraw - $model->TotalFee)/100;
                }
            ],
            [
                'attribute' => 'TotalRake',
                'format' => 'raw',
                'value' => function($model){
                    return $model->TotalRake/100;
                }
            ],
            [
                'attribute' => 'UseBonus',
                'format' => 'raw',
                'value' => function($model){
                    return $model->UseBonus/100;
                }
            ],
            [
                'attribute' => Yii::t('app', 'NetRake'),
                'format' => 'raw',
                'value' => function($model){
                    return ($model->TotalRake - $model->UseBonus)/100;
                }
            ],
        ],
    ]); ?>


</div>
