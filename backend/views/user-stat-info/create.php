<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserStatInfo */

$this->title = Yii::t('app', 'Add User Stat Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Stat Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-stat-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
