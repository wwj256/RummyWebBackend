<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ScoreInfo */

$this->title = Yii::t('app', 'Update Score Info: {name}', [
    'name' => $model->UserID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Score Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="score-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
