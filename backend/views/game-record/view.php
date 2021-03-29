<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecord */

$this->title = $model->RcdId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-record-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'RcdId' => $model->RcdId, 'Turns' => $model->Turns], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'RcdId' => $model->RcdId, 'Turns' => $model->Turns], [
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
            'RcdId',
            'Turns',
            'GameId',
            'RoomId',
            'PlyNum',
            'Tax',
            'SysWin',
            'Procedure',
            'TimeCost:datetime',
            'BeginTime',
        ],
    ]) ?>

</div>
