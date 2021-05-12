<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SpreadID')->textInput() ?>

    <?= $form->field($model, 'UniqueID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NickName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FaceUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IsRobot')->textInput() ?>

    <?= $form->field($model, 'Platform')->textInput() ?>

    <?= $form->field($model, 'RegisterIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RegisterDate')->textInput() ?>

    <?= $form->field($model, 'RegisterMachine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ClientVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LoginIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LoginDate')->textInput() ?>

    <?= $form->field($model, 'LoginMachine')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
