<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserMailInfo */

$this->title = Yii::t('app', 'Update User Mail Info: {name}', [
    'name' => $model->Title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Mail Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-mail-info-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
