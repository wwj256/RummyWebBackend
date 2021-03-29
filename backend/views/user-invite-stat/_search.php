<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserInviteStatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-invite-stat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UID') ?>

    <?= $form->field($model, 'DayStat') ?>

    <?= $form->field($model, 'TotalBonus') ?>

    <?= $form->field($model, 'InviteBonus') ?>

    <?= $form->field($model, 'DepositBonus') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
