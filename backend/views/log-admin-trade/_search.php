<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LogAdminTradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-admin-trade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'Score') ?>

    <?= $form->field($model, 'SChange') ?>

    <?= $form->field($model, 'AdminID') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
