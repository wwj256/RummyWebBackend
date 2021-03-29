<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RobotConfig */

$this->title = Yii::t('app', 'Update Robot Config: {name}', [
    'name' => $model->UID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Robot Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UID, 'url' => ['view', 'id' => $model->UID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="robot-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
