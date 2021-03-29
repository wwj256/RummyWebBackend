<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteInfo */

$this->title = Yii::t('app', 'Add User Invite Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invite-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
