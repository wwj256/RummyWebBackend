<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RoomID') ?>

    <?= $form->field($model, 'GameID') ?>

    <?= $form->field($model, 'RoomStatus') ?>

    <?= $form->field($model, 'MainSrvId') ?>

    <?= $form->field($model, 'SubSrvId') ?>

    <?php // echo $form->field($model, 'ConfJson') ?>

    <?php // echo $form->field($model, 'UpdateTime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
