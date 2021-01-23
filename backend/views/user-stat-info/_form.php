<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserStatInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-stat-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'TPayScore')->textInput() ?>

    <?= $form->field($model, 'TPayCnt')->textInput() ?>

    <?= $form->field($model, 'TDrawScore')->textInput() ?>

    <?= $form->field($model, 'TDrawCnt')->textInput() ?>

    <?= $form->field($model, 'TGameCnt')->textInput() ?>

    <?= $form->field($model, 'TBrokeUp')->textInput() ?>

    <?= $form->field($model, 'TWinScore')->textInput() ?>

    <?= $form->field($model, 'TLostScore')->textInput() ?>

    <?= $form->field($model, 'TPointCnt')->textInput() ?>

    <?= $form->field($model, 'TPoolCnt')->textInput() ?>

    <?= $form->field($model, 'TDealCnt')->textInput() ?>

    <?= $form->field($model, 'TPoint10Cnt')->textInput() ?>

    <?= $form->field($model, 'TMatchCnt')->textInput() ?>

    <?= $form->field($model, 'TTicketScore')->textInput() ?>

    <?= $form->field($model, 'TAssistScore')->textInput() ?>

    <?= $form->field($model, 'TInviteScore')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
