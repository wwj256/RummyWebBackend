<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserOrderInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-order-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OrderID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OrderAmount')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'UserEndScore')->textInput() ?>

    <?= $form->field($model, 'CouponID')->textInput() ?>

    <?= $form->field($model, 'Amount')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'ReferenceId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PaymentMode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PayTime')->textInput() ?>

    <?= $form->field($model, 'CreateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
