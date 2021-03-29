<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\GameRoom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-room-form">

    <?php $form = ActiveForm::begin([
    'id' => 'game-room-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'GameID')->textInput() ?>

    <?= $form->field($model, 'RoomStatus')->textInput() ?>

    <?= $form->field($model, 'MainSrvId')->textInput() ?>

    <?= $form->field($model, 'SubSrvId')->textInput() ?>

    <?= $form->field($model, 'ConfJson')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'UpdateTime')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
