<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecord */

$this->title = Yii::t('app', 'Update Game Record: {name}', [
    'name' => $model->RcdId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RcdId, 'url' => ['view', 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="game-record-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
