<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\UserOrderInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-order-info-search">

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

        <?= $form->field($model, 'OrderID') ?>

        <?= $form->field($model, 'UserID') ?>

        <?= $form->field($model, 'NickName')->label("NickName") ?>

        <?= $form->field($model, 'create_time')->label('CreateTime')->widget(DateTimePicker::classname(), [
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
    </div>


    <?php // echo $form->field($model, 'CouponID') ?>

    <?php // echo $form->field($model, 'Amount') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'ReferenceId') ?>

    <?php // echo $form->field($model, 'PaymentMode') ?>

    <?php // echo $form->field($model, 'PayTime') ?>

    <?php // echo $form->field($model, 'CreateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name'=>'action', 'value'=>'search']) ?>
        <?php //Html::submitButton('Expor Data', ['class' => 'btn btn-success', 'name'=>'action', 'value'=>'export']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
