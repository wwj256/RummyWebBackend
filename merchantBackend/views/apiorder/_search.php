<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ApiorderSearchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apiorder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'oid') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'app_key') ?>

    <?= $form->field($model, 'payuid') ?>

    <?= $form->field($model, 'ostate') ?>

    <?php // echo $form->field($model, 'order_id') ?>

    <?php // echo $form->field($model, 'amount_type') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'order_fee') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'return_url') ?>

    <?php // echo $form->field($model, 'notify_url') ?>

    <?php // echo $form->field($model, 'clienttime') ?>

    <?php // echo $form->field($model, 'order_ip') ?>

    <?php // echo $form->field($model, 'extra') ?>

    <?php // echo $form->field($model, 'lang') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <div class="form-group">
        <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
