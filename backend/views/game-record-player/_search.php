<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordPlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-record-player-search">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-inline'],
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{label}\n{input}",
            'labelOptions' => ['class' => 'form-label','style'=>'width:auto;margin-left:10px'],
        ],
    ]); ?>

    <div class="row" style="margin: 20px 0px 20px 0px" >
        <?= $form->field($model, 'RcdId')->label('GameRecordID') ?>

        <?= $form->field($model, 'Turns') ?>

        <?= $form->field($model, 'UID') ?>


        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-danger']) ?>

    </div>

    <?php // echo $form->field($model, 'BeginScore') ?>

    <?php // echo $form->field($model, 'WinScore') ?>

    <?php // echo $form->field($model, 'Bind') ?>

    <?php // echo $form->field($model, 'BindChg') ?>

    <?php // echo $form->field($model, 'Bonus') ?>

    <?php // echo $form->field($model, 'BonusChg') ?>

    <?php // echo $form->field($model, 'PlyTax') ?>

    <?php // echo $form->field($model, 'BeginTime') ?>


    <?php ActiveForm::end(); ?>

</div>
