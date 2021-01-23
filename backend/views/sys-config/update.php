<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysConfig */

$this->title = Yii::t('app', 'Update Sys Config: {name}', [
    'name' => $model->K,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->K, 'url' => ['view', 'id' => $model->K]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sys-config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
