<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\ScoreInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="score-info-form">

    <?php $form = ActiveForm::begin([
    'id' => 'score-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'BindScore')->textInput() ?>

    <?= $form->field($model, 'LockScore')->textInput() ?>

    <?= $form->field($model, 'BonusScore')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
