<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-info-search">

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
        <?= $form->field($model, 'UserID') ?>

        <?= $form->field($model, 'NickName') ?>

        <?= $form->field($model, 'RegisterIP') ?>

        <?= $form->field($model, 'create_time')->label('RegisterDate')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['create_time'])?$model['create_time']:'Start date','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',

            ]
        ]); ?>
        <label class=" form-label">-</label>

        <?= $form->field($model, 'end_time')->label(false)->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['end_time'])?$model['end_time']:'End date','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>

        <?= $form->field($model, 'login_startTime')->label('LoginDate')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['login_startTime'])?$model['login_startTime']:'Start date','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',

            ]
        ]); ?>
        <label class=" form-label">-</label>

        <?= $form->field($model, 'login_endTime')->label(false)->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['login_endTime'])?$model['login_endTime']:'End date','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>
    </div>



    <?php // echo $form->field($model, 'FaceUrl') ?>

    <?php // echo $form->field($model, 'IsRobot') ?>

    <?php // echo $form->field($model, 'Platform') ?>

    <?php // echo $form->field($model, 'RegisterIP') ?>

    <?php // echo $form->field($model, 'RegisterDate') ?>

    <?php // echo $form->field($model, 'RegisterMachine') ?>

    <?php // echo $form->field($model, 'ClientVersion') ?>

    <?php // echo $form->field($model, 'LoginIP') ?>

    <?php // echo $form->field($model, 'LoginDate') ?>

    <?php // echo $form->field($model, 'LoginMachine') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name'=>'action', 'value'=>'search']) ?>
        <?= Html::submitButton('Export Data', ['class' => 'btn btn-success', 'name'=>'action', 'value'=>'export']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
