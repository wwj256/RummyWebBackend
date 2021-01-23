<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\UserBindInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bind-info-form">

    <?php $form = ActiveForm::begin([
    'id' => 'user-bind-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'UniqueID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacebookID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GoogleID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RealName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PayName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PayPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PayEmail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
