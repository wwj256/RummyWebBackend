<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\UserClubInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-club-info-form">

    <?php $form = ActiveForm::begin([
    'id' => 'user-club-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'LoyalPoints')->textInput() ?>

    <?= $form->field($model, 'RedeemScore')->textInput() ?>

    <?= $form->field($model, 'Level')->textInput() ?>

    <?= $form->field($model, 'Counts')->textInput() ?>

    <?= $form->field($model, 'TotalScore')->textInput() ?>

    <?= $form->field($model, 'RecordTime')->textInput() ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
