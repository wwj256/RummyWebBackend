<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountInfo */

$this->title = '添加 Account Info';
$this->params['breadcrumbs'][] = ['label' => 'Account Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
