<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserScoreChange */

$this->title = Yii::t('app', 'Add User Score Change');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Score Changes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-score-change-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
