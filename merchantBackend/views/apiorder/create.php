<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apiorder */

$this->title = '添加 Apiorder';
$this->params['breadcrumbs'][] = ['label' => 'Apiorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apiorder-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
