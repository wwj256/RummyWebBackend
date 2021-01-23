<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteInfo */

$this->title = Yii::t('app', 'Update User Invite Info: {name}', [
    'name' => $model->UserID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Invite Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-invite-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
