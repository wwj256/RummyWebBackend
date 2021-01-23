<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordPlayer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-record-player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'RcdId')->textInput() ?>

    <?= $form->field($model, 'Turns')->textInput() ?>

    <?= $form->field($model, 'NewUser')->textInput() ?>

    <?= $form->field($model, 'SpreadID')->textInput() ?>

    <?= $form->field($model, 'BeginScore')->textInput() ?>

    <?= $form->field($model, 'WinScore')->textInput() ?>

    <?= $form->field($model, 'Bind')->textInput() ?>

    <?= $form->field($model, 'BindChg')->textInput() ?>

    <?= $form->field($model, 'Bonus')->textInput() ?>

    <?= $form->field($model, 'BonusChg')->textInput() ?>

    <?= $form->field($model, 'PlyTax')->textInput() ?>

    <?= $form->field($model, 'BeginTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
