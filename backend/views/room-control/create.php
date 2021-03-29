<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RoomControl */

$this->title = Yii::t('app', 'Create Room Control');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Controls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-control-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
