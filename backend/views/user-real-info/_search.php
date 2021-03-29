<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRealInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-real-info-search">

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

            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>

    </div>


    <?php // echo $form->field($model, 'CardID') ?>

    <?php // echo $form->field($model, 'Birth') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'RecordTime') ?>



    <?php ActiveForm::end(); ?>

</div>
