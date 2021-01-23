<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RoomControl */

$this->title = Yii::t('app', 'Update Room Control: {name}', [
    'name' => $model->RoomID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Controls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RoomID, 'url' => ['view', 'id' => $model->RoomID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-control-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
