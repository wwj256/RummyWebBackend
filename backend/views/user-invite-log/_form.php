<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-log-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'InviteUID')->textInput() ?>

    <?= $form->field($model, 'RelateID')->textInput() ?>

    <?= $form->field($model, 'OutBonus')->textInput() ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
