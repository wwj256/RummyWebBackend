<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserActionStat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-action-stat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UniqueID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'Loading')->textInput() ?>

    <?= $form->field($model, 'Lobby')->textInput() ?>

    <?= $form->field($model, 'NewGuide')->textInput() ?>

    <?= $form->field($model, 'FinishGuide')->textInput() ?>

    <?= $form->field($model, 'EnterPractise')->textInput() ?>

    <?= $form->field($model, 'EnterGold')->textInput() ?>

    <?= $form->field($model, 'FinishGame')->textInput() ?>

    <?= $form->field($model, 'BrakeUp')->textInput() ?>

    <?= $form->field($model, 'BrakeOpenPayWeb')->textInput() ?>

    <?= $form->field($model, 'BrakeOpenActivity')->textInput() ?>

    <?= $form->field($model, 'OpenDraw')->textInput() ?>

    <?= $form->field($model, 'OpenVip')->textInput() ?>

    <?= $form->field($model, 'OpenShare')->textInput() ?>

    <?= $form->field($model, 'NetBrake')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
