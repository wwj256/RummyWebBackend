<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLoginOut */

$this->title = Yii::t('app', 'Add User Login Out');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Login Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login-out-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
