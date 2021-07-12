<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminLog */

$this->title = '修改 Admin Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-log-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
