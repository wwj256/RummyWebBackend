<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\DayReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<script >
    function updateDateReport() {
        let dateTxt = document.getElementById('updateDateTxt').value;
        var matchArray=dateTxt.match(/^([0-9]{4})-([0-1][0-9])-([0-3][0-9])$/);
        if( matchArray == null ){//检测是否是正确的日期格式
            alert('The format of the input date is incorrect. Please reenter it');
            return;
        }
        $.post("/day-report/change-day-report?dayTime="+dateTxt, function (data){
            alert(data);
            window.location.reload();
        });
    }
</script>
<div class="day-report-search">

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

        <?= $form->field($model, 'create_time')->label('DayDate')->widget(DateTimePicker::classname(), [
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
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <div >
        <input type="text" id="updateDateTxt" placeholder="Date Time" maxlength="255" style="width:100;height:30px">
        <button type="button" class="btn btn-danger" onclick="updateDateReport()" >Update</button>
        <div style='display:inline'>update day report.date format 2021-01-01</div>
    </div>
    
</div>
