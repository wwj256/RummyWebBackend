<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLoginOut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-login-out-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'IsLogin')->textInput() ?>

    <?= $form->field($model, 'SpreadID')->textInput() ?>

    <?= $form->field($model, 'IsNew')->textInput() ?>

    <?= $form->field($model, 'OnTime')->textInput() ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
