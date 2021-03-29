<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysConfig */

$this->title = Yii::t('app', 'Add Sys Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-config-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
