<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpreadConfig */

$this->title = Yii::t('app', 'Update Spread Config: {name}', [
    'name' => $model->ID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spread Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="spread-config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
