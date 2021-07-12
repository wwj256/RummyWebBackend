<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBackend */

$this->title = '添加新用户';
$this->params['breadcrumbs'][] = ['label' => 'User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->label('登陆名')->textInput(['autofocus' => true,'value'=>'','autocomplete'=>"off"]) ?>


            <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true,'placeholder' => '请输入新密码','onfocus'=>"this.type='password'",'autocomplete'=>"new-password",'value'=>''])->label('密码') ?>
            <div class="form-group">
                <?= Html::submitButton('添加', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
