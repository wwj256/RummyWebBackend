<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteInfo */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-invite-info-view">
    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->UserID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->UserID], [
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
            'UserID',
            'MyInviter',
            'InviteCounts',
            'TotalBonus',
            'InviteBonus',
            'DepositBonus',
            'TodayOutBonus',
            'TotalOutBonus',
            'RecordTime',
        ],
    ]) ?>

</div>
