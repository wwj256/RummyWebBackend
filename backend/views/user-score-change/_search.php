<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserScoreChangeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-score-change-search">

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
        <?= $form->field($model, 'UID') ?>

        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
