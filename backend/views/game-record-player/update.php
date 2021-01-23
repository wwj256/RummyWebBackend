<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecordPlayer */

$this->title = Yii::t('app', 'Update Game Record Player: {name}', [
    'name' => $model->UID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Record Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UID, 'url' => ['view', 'UID' => $model->UID, 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="game-record-player-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
