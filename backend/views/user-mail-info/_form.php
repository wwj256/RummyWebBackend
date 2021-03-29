<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserMailInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-mail-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SysID')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'SendTime')->textInput() ?>

    <?= $form->field($model, 'ExpireTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
