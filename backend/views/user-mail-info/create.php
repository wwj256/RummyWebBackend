<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserMailInfo */

$this->title = Yii::t('app', 'Add User Mail Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Mail Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-mail-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
