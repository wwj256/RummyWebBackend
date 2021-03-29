<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameType */

$this->title = Yii::t('app', '修改 Game Type: {name}', [
    'name' => $model->GameID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GameID, 'url' => ['view', 'id' => $model->GameID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="game-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
