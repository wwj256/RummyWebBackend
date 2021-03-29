<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRealInfo */

$this->title = Yii::t('app', 'Update User Real Info: {name}', [
    'name' => $model->Name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Real Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-real-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
