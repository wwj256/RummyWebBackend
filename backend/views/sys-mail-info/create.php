<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysMailInfo */

$this->title = Yii::t('app', 'Add Sys Mail Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Mail Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-mail-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
