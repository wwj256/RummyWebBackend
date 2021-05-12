<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GameID')->textInput() ?>

    <?= $form->field($model, 'GameName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
