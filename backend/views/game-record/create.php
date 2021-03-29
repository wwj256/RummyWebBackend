<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameRecord */

$this->title = Yii::t('app', 'Add Game Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-record-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
