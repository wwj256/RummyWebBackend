<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LogAdminTrade */

$this->title = Yii::t('app', 'Update Log Admin Trade: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Log Admin Trades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="log-admin-trade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
