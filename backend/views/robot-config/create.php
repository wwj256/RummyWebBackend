<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RobotConfig */

$this->title = Yii::t('app', 'Create Robot Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Robot Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="robot-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
