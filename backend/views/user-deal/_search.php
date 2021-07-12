<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDealSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-deal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'Password') ?>

    <?= $form->field($model, 'Phone') ?>

    <?= $form->field($model, 'Score') ?>

    <?= $form->field($model, 'CreateDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
