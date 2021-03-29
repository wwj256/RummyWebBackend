<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserMailInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-mail-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'SysID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'Content') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'SendTime') ?>

    <?php // echo $form->field($model, 'ExpireTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
