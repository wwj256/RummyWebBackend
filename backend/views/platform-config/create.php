<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PlatformConfig */

$this->title = Yii::t('app', 'Add Platform Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Platform Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platform-config-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
