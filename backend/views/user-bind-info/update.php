<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBindInfo */

$this->title = Yii::t('app', 'Update User Bind Info: {name}', [
    'name' => $model->UserID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Bind Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-bind-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
