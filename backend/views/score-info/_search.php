<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ScoreInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="score-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'Score') ?>

    <?= $form->field($model, 'BindScore') ?>

    <?= $form->field($model, 'LockScore') ?>

    <?= $form->field($model, 'BonusScore') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
