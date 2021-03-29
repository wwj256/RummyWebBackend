<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLoginOut */

$this->title = Yii::t('app', 'Update User Login Out: {name}', [
    'name' => $model->ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Login Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-login-out-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
