<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SpreadConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spread-config-form">

    <?php $form = ActiveForm::begin([
    'id' => 'spread-config-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>


    <?= $form->field($model, 'RegVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApkUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HotUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PageUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Notice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CurVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UpdateMode')->textInput() ?>

    <?= $form->field($model, 'ApkVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PacketUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Conf')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
