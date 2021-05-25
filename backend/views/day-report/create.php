<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayReport */

$this->title = Yii::t('app', 'Add Day Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-report-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
