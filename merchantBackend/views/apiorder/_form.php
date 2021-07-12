<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Apiorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apiorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'app_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payuid')->textInput() ?>

    <?= $form->field($model, 'ostate')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'order_fee')->textInput() ?>

    <?= $form->field($model, 'body')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notify_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clienttime')->textInput() ?>

    <?= $form->field($model, 'order_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
