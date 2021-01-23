<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'MyInviter') ?>

    <?= $form->field($model, 'InviteCounts') ?>

    <?= $form->field($model, 'TotalBonus') ?>

    <?= $form->field($model, 'InviteBonus') ?>

    <?php // echo $form->field($model, 'DepositBonus') ?>

    <?php // echo $form->field($model, 'TodayOutBonus') ?>

    <?php // echo $form->field($model, 'TotalOutBonus') ?>

    <?php // echo $form->field($model, 'RecordTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
