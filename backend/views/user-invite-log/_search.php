<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'InviteUID') ?>

    <?= $form->field($model, 'RelateID') ?>

    <?= $form->field($model, 'OutBonus') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
