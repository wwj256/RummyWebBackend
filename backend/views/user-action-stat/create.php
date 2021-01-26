<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserActionStat */

$this->title = Yii::t('app', 'Add User Action Stat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Action Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-action-stat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
