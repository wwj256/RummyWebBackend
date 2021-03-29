<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserClubInfo */

$this->title = Yii::t('app', 'Create User Club Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Club Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-club-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
