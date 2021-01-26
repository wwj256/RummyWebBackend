<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SysMailInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-mail-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SpreadID')->textInput() ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SendTime')->textInput() ?>

    <?= $form->field($model, 'ExpireTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
