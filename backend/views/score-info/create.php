<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ScoreInfo */

$this->title = Yii::t('app', 'Create Score Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Score Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="score-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
