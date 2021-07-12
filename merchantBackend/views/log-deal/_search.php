<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model merchantBackend\models\LogDealSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-deal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'Type') ?>

    <?= $form->field($model, 'Score') ?>

    <?= $form->field($model, 'DealScore') ?>

    <?php // echo $form->field($model, 'TargetID') ?>

    <?php // echo $form->field($model, 'TargetPhone') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
