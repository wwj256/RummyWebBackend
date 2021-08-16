<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBindInfo */

$this->title = Yii::t('app', 'Add User Bind Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Bind Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bind-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
