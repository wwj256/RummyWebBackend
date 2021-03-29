<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RcdId')->textInput() ?>

    <?= $form->field($model, 'Turns')->textInput() ?>

    <?= $form->field($model, 'GameId')->textInput() ?>

    <?= $form->field($model, 'RoomId')->textInput() ?>

    <?= $form->field($model, 'PlyNum')->textInput() ?>

    <?= $form->field($model, 'Tax')->textInput() ?>

    <?= $form->field($model, 'SysWin')->textInput() ?>

    <?= $form->field($model, 'Procedure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TimeCost')->textInput() ?>

    <?= $form->field($model, 'BeginTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
