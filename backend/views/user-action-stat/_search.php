<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserActionStatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-action-stat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UniqueID') ?>

    <?= $form->field($model, 'UID') ?>

    <?= $form->field($model, 'Loading') ?>

    <?= $form->field($model, 'Lobby') ?>

    <?= $form->field($model, 'NewGuide') ?>

    <?php // echo $form->field($model, 'FinishGuide') ?>

    <?php // echo $form->field($model, 'EnterPractise') ?>

    <?php // echo $form->field($model, 'EnterGold') ?>

    <?php // echo $form->field($model, 'FinishGame') ?>

    <?php // echo $form->field($model, 'BrakeUp') ?>

    <?php // echo $form->field($model, 'BrakeOpenPayWeb') ?>

    <?php // echo $form->field($model, 'BrakeOpenActivity') ?>

    <?php // echo $form->field($model, 'OpenDraw') ?>

    <?php // echo $form->field($model, 'OpenVip') ?>

    <?php // echo $form->field($model, 'OpenShare') ?>

    <?php // echo $form->field($model, 'NetBrake') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
