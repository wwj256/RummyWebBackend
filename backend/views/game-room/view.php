<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRoom */

$this->title = $model->RoomID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-room-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->RoomID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->RoomID], [
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
            'RoomID',
            'GameID',
            'RealGameID',
            'HaveRbt',
            'ActivPlayer',
            'RoomStatus',
            'MainSrvId',
            'SubSrvId',
            'ConfJson',
            'UpdateTime',
        ],
    ]) ?>

</div>
