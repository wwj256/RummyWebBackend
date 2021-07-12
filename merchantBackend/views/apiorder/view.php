<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Apiorder */

$this->title = $model->oid;
$this->params['breadcrumbs'][] = ['label' => 'Apiorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="apiorder-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->oid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->oid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此项吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'oid',
            'uid',
            'app_key',
            'payuid',
            'ostate',
            'order_id',
            'amount_type',
            'amount',
            'order_fee',
            'body',
            'return_url:url',
            'notify_url:url',
            'clienttime:datetime',
            'order_ip',
            'extra',
            'lang',
            'createtime',
            'updatetime',
        ],
    ]) ?>

</div>
