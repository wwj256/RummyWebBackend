<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminLog */

$this->title = '添加 Admin Log';
$this->params['breadcrumbs'][] = ['label' => 'Admin Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
