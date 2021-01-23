<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteStat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-stat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'DayStat')->textInput() ?>

    <?= $form->field($model, 'TotalBonus')->textInput() ?>

    <?= $form->field($model, 'InviteBonus')->textInput() ?>

    <?= $form->field($model, 'DepositBonus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
