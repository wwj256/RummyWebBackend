<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteStat */

$this->title = Yii::t('app', 'Add User Invite Stat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invite-stat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
