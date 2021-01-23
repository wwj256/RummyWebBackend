<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountInfo */

$this->title = '修改 Account Info: ' . $model->UserID;
$this->params['breadcrumbs'][] = ['label' => 'Account Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'id' => $model->UserID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
