<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpreadConfig */

$this->title = Yii::t('app', 'Create Spread Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spread Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spread-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
