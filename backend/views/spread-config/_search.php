<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpreadConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spread-config-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'SpreadID') ?>

    <?= $form->field($model, 'RegVersion') ?>

    <?= $form->field($model, 'ApkUrl') ?>

    <?= $form->field($model, 'HotUrl') ?>

    <?php // echo $form->field($model, 'PageUrl') ?>

    <?php // echo $form->field($model, 'Notice') ?>

    <?php // echo $form->field($model, 'CurVersion') ?>

    <?php // echo $form->field($model, 'UpdateMode') ?>

    <?php // echo $form->field($model, 'ApkVersion') ?>

    <?php // echo $form->field($model, 'PacketUrl') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
