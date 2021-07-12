<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model merchantBackend\models\LogDeal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-deal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Type')->textInput() ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'DealScore')->textInput() ?>

    <?= $form->field($model, 'TargetID')->textInput() ?>

    <?= $form->field($model, 'TargetPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
