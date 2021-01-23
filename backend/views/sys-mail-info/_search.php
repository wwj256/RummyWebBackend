<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SysMailInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-mail-info-search">

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
        <?= $form->field($model, 'ID') ?>

        <?= $form->field($model, 'Type') ?>

        <?= $form->field($model, 'SpreadID') ?>

        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>


        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-danger']) ?>

    </div>


    <?php // echo $form->field($model, 'SendTime') ?>

    <?php // echo $form->field($model, 'ExpireTime') ?>


    <?php ActiveForm::end(); ?>

</div>
