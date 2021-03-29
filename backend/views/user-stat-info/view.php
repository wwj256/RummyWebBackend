<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserStatInfo */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Stat Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-stat-info-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->UserID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->UserID], [
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
            'TPayScore',
            'TPayCnt',
            'TDrawScore',
            'TDrawCnt',
            'TGameCnt',
            'TBrokeUp',
            'TWinScore',
            'TLostScore',
            'TPointCnt',
            'TPoolCnt',
            'TDealCnt',
            'TPoint10Cnt',
            'TMatchCnt',
            'TTicketScore',
            'TAssistScore',
            'TInviteScore',
        ],
    ]) ?>

</div>
