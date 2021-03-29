<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserStatInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-stat-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'TPayScore') ?>

    <?= $form->field($model, 'TPayCnt') ?>

    <?= $form->field($model, 'TDrawScore') ?>

    <?= $form->field($model, 'TDrawCnt') ?>

    <?php // echo $form->field($model, 'TGameCnt') ?>

    <?php // echo $form->field($model, 'TBrokeUp') ?>

    <?php // echo $form->field($model, 'TWinScore') ?>

    <?php // echo $form->field($model, 'TLostScore') ?>

    <?php // echo $form->field($model, 'TPointCnt') ?>

    <?php // echo $form->field($model, 'TPoolCnt') ?>

    <?php // echo $form->field($model, 'TDealCnt') ?>

    <?php // echo $form->field($model, 'TPoint10Cnt') ?>

    <?php // echo $form->field($model, 'TMatchCnt') ?>

    <?php // echo $form->field($model, 'TTicketScore') ?>

    <?php // echo $form->field($model, 'TAssistScore') ?>

    <?php // echo $form->field($model, 'TInviteScore') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
