<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserCouponInfo */

$this->title = Yii::t('app', 'Add User Coupon Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Coupon Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-coupon-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
