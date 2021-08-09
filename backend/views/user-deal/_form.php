<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDeal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-deal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Password')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'Score')->textInput()->label('当前金币(单位：分)') ?>

    <?= $form->field($model, 'LoginIP')->textInput() ?>

    <?= $form->field($model, 'LoginDate')->textInput() ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
