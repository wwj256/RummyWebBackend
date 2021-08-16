<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBindInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bind-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'UniqueID') ?>

    <?= $form->field($model, 'Phone') ?>

    <?= $form->field($model, 'FacebookID') ?>

    <?= $form->field($model, 'Mail') ?>

    <?php // echo $form->field($model, 'GoogleID') ?>

    <?php // echo $form->field($model, 'AppleID') ?>

    <?php // echo $form->field($model, 'RealName') ?>

    <?php // echo $form->field($model, 'PayName') ?>

    <?php // echo $form->field($model, 'PayPhone') ?>

    <?php // echo $form->field($model, 'PayEmail') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
