<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserActionStat */

$this->title = Yii::t('app', 'Update User Action Stat: {name}', [
    'name' => $model->UniqueID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Action Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UniqueID, 'url' => ['view', 'id' => $model->UniqueID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-action-stat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
