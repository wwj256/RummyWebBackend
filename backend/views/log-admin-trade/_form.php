<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LogAdminTrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-admin-trade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'SChange')->textInput() ?>

    <?= $form->field($model, 'AdminID')->textInput() ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
