<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PlatformConfig */

$this->title = Yii::t('app', 'Update Platform Config: {name}', [
    'name' => $model->K,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Platform Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->K, 'url' => ['view', 'id' => $model->K]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="platform-config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
