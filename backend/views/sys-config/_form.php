<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SysConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'K')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'V')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Info')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
