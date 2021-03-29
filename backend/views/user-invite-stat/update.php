<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteStat */

$this->title = Yii::t('app', 'Update User Invite Stat: {name}', [
    'name' => $model->UID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UID, 'url' => ['view', 'UID' => $model->UID, 'DayStat' => $model->DayStat]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-invite-stat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
