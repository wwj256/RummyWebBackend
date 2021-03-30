<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

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

        <?= $form->field($model, 'create_time')->label('获得日期范围')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['create_time'])?$model['create_time']:'开始日','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',

            ]
        ]); ?>
        <label class=" form-label">至</label>

        <?= $form->field($model, 'end_time')->label(false)->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($model['end_time'])?$model['end_time']:'截至日','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name'=>'action', 'value'=>'search']) ?>
        <?= Html::submitButton('Expor Data', ['class' => 'btn btn-success', 'name'=>'action', 'value'=>'export']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
