<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserScoreChange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-score-change-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'NewUser')->textInput() ?>

    <?= $form->field($model, 'SpreadID')->textInput() ?>

    <?= $form->field($model, 'SType')->textInput() ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'SChange')->textInput() ?>

    <?= $form->field($model, 'Bind')->textInput() ?>

    <?= $form->field($model, 'BindChg')->textInput() ?>

    <?= $form->field($model, 'Bonus')->textInput() ?>

    <?= $form->field($model, 'BonusChg')->textInput() ?>

    <?= $form->field($model, 'RelateID')->textInput() ?>

    <?= $form->field($model, 'Reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
