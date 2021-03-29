<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SpreadConfig */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spread Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="spread-config-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'SpreadID',
            'RegVersion',
            'ApkUrl',
            'HotUrl',
            'PageUrl',
            'Notice',
            'CurVersion',
            'UpdateMode',
            'ApkVersion',
            'PacketUrl',
            'Conf',
        ],
    ]) ?>

</div>
