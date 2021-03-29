<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteLog */

$this->title = Yii::t('app', 'Add User Invite Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invite-log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
