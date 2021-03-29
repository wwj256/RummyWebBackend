<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysMailInfo */

$this->title = Yii::t('app', 'Update Sys Mail Info: {name}', [
    'name' => $model->Title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Mail Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sys-mail-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
