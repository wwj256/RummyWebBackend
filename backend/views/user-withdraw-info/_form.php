<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\UserWithdrawInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-withdraw-info-form">

    <?php $form = ActiveForm::begin([
    'id' => 'user-withdraw-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Amount')->textInput() ?>

    <?= $form->field($model, 'BeforeScore')->textInput() ?>

    <?= $form->field($model, 'Tax')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'ClubLV')->textInput() ?>

    <?= $form->field($model, 'OperatorID')->textInput() ?>

    <?= $form->field($model, 'OperatorTime')->textInput() ?>

    <?= $form->field($model, 'WithDrawTime')->textInput() ?>

    <?= $form->field($model, 'CreateTime')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
