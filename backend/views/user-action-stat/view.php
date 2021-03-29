<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserActionStat */

$this->title = $model->UniqueID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Action Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-action-stat-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->UniqueID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->UniqueID], [
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
            'UniqueID',
            'UID',
            'Loading',
            'Lobby',
            'NewGuide',
            'FinishGuide',
            'EnterPractise',
            'EnterGold',
            'FinishGame',
            'BrakeUp',
            'BrakeOpenPayWeb',
            'BrakeOpenActivity',
            'OpenDraw',
            'OpenVip',
            'OpenShare',
            'NetBrake',
        ],
    ]) ?>

</div>
