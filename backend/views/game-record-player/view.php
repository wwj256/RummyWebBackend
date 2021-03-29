<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordPlayer */

$this->title = $model->UID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Record Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-record-player-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'UID' => $model->UID, 'RcdId' => $model->RcdId, 'Turns' => $model->Turns], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'UID' => $model->UID, 'RcdId' => $model->RcdId, 'Turns' => $model->Turns], [
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
            'UID',
            'RcdId',
            'Turns',
            'NewUser',
            'SpreadID',
            'BeginScore',
            'WinScore',
            'Bind',
            'BindChg',
            'Bonus',
            'BonusChg',
            'PlyTax',
            'BeginTime',
        ],
    ]) ?>

</div>
