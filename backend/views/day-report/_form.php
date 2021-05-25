<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DayReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="day-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DayDate')->textInput() ?>

    <?= $form->field($model, 'NewPlayers')->textInput() ?>

    <?= $form->field($model, 'FirstDeposit')->textInput() ?>

    <?= $form->field($model, 'SecondDeposit')->textInput() ?>

    <?= $form->field($model, 'AverageOnline')->textInput() ?>

    <?= $form->field($model, 'TotalDeposit')->textInput() ?>

    <?= $form->field($model, 'TotalWithdraw')->textInput() ?>

    <?= $form->field($model, 'TotalBonus')->textInput() ?>

    <?= $form->field($model, 'TotalFee')->textInput() ?>

    <?= $form->field($model, 'TotalRake')->textInput() ?>

    <?= $form->field($model, 'UseBonus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
