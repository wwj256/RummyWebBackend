<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRoom */

$this->title = Yii::t('app', 'Create Game Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
