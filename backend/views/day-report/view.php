<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DayReport */

$this->title = $model->DayDate;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="day-report-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->DayDate], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->DayDate], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
    ]) ?>

</div>
