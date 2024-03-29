<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Tiltle') ?>

    <?= $form->field($model, 'Url') ?>

    <?= $form->field($model, 'JumpTo') ?>

    <?= $form->field($model, 'StartTime') ?>

    <?php // echo $form->field($model, 'EndTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
