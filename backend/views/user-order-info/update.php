<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserOrderInfo */

$this->title = Yii::t('app', 'Update User Order Info: {name}', [
    'name' => $model->ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Order Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-order-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
