<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model merchantBackend\models\LogDeal */

$this->title = 'Update Log Deal: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Log Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-deal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
