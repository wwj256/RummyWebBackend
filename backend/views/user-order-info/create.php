<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserOrderInfo */

$this->title = Yii::t('app', 'Add User Order Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Order Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
