<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GameType */

$this->title = Yii::t('app', 'add Game Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
