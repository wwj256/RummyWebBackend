<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\RobotConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="robot-config-form">

    <?php $form = ActiveForm::begin([
    'id' => 'robot-config-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UID')->textInput() ?>

    <?= $form->field($model, 'SrvID')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
