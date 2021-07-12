<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apiorder */

$this->title = '修改 Apiorder: ' . $model->oid;
$this->params['breadcrumbs'][] = ['label' => 'Apiorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oid, 'url' => ['view', 'id' => $model->oid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apiorder-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
