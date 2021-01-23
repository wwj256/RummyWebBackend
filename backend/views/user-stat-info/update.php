<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserStatInfo */

$this->title = Yii::t('app', 'Update User Stat Info: {name}', [
    'name' => $model->UserID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Stat Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-stat-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
