<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordPlayer */

$this->title = Yii::t('app', 'Add Game Record Player');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Record Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-record-player-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
