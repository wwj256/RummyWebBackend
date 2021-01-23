<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserClubInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-club-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'LoyalPoints') ?>

    <?= $form->field($model, 'RedeemScore') ?>

    <?= $form->field($model, 'Level') ?>

    <?= $form->field($model, 'Counts') ?>

    <?php // echo $form->field($model, 'TotalScore') ?>

    <?php // echo $form->field($model, 'RecordTime') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
