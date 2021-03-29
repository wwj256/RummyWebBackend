<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\UserRealInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-real-info-form">

    <?php $form = ActiveForm::begin([
    'id' => 'user-real-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Type')->textInput() ?>

    <?= $form->field($model, 'FrontUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BackUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CardID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Birth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'RecordTime')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
