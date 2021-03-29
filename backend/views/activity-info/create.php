<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityInfo */

$this->title = Yii::t('app', 'Create Activity Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
