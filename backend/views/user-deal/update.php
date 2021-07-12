<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDeal */

$this->title = Yii::t('app', 'Update User Deal: {name}', [
    'name' => $model->UserID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Deals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-deal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
