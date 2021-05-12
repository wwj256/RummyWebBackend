<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GameType */

$this->title = $model->GameID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Game Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-type-view">

    <p>
        <?= Html::a(Yii::t('app', '修改'), ['update', 'id' => $model->GameID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->GameID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item？'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'GameID',
            'GameName',
        ],
    ]) ?>

</div>
