<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LogAdminTrade */

$this->title = Yii::t('app', 'Add Log Admin Trade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Log Admin Trades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-admin-trade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
