<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserScoreChange */

$this->title = Yii::t('app', 'Update User Score Change: {name}', [
    'name' => $model->ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Score Changes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-score-change-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
