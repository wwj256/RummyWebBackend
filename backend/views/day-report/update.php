<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayReport */

$this->title = Yii::t('app', 'Update Day Report: {name}', [
    'name' => $model->DayDate,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DayDate, 'url' => ['view', 'id' => $model->DayDate]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="day-report-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
