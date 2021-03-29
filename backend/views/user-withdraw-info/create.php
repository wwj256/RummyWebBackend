<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserWithdrawInfo */

$this->title = Yii::t('app', 'Create User Withdraw Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Withdraw Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-withdraw-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
