<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\RoomControl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-control-form">

    <?php $form = ActiveForm::begin([
    'id' => 'room-control-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'RoomID')->textInput() ?>

    <?= $form->field($model, 'InitScore')->textInput() ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'MaxScore')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
