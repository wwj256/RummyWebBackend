<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'MyInviter')->textInput() ?>

    <?= $form->field($model, 'InviteCounts')->textInput() ?>

    <?= $form->field($model, 'TotalBonus')->textInput() ?>

    <?= $form->field($model, 'InviteBonus')->textInput() ?>

    <?= $form->field($model, 'DepositBonus')->textInput() ?>

    <?= $form->field($model, 'TodayOutBonus')->textInput() ?>

    <?= $form->field($model, 'TotalOutBonus')->textInput() ?>

    <?= $form->field($model, 'RecordTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
