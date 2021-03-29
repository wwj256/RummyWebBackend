<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-record-search">

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
        <?= $form->field($model, 'RcdId') ?>

        <?= $form->field($model, 'Turns') ?>

        <?= $form->field($model, 'GameId') ?>

        <?= $form->field($model, 'RoomId') ?>

        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-danger']) ?>

    </div>



    <?php // echo $form->field($model, 'Tax') ?>

    <?php // echo $form->field($model, 'SysWin') ?>

    <?php // echo $form->field($model, 'Procedure') ?>

    <?php // echo $form->field($model, 'TimeCost') ?>

    <?php // echo $form->field($model, 'BeginTime') ?>

    <?php ActiveForm::end(); ?>

</div>
