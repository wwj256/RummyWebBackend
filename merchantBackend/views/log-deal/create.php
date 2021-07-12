<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model merchantBackend\models\LogDeal */

$this->title = 'Add Log Deal';
$this->params['breadcrumbs'][] = ['label' => 'Log Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-deal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
