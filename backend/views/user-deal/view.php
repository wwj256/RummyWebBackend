<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDeal */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Deals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-deal-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserID',
            'Password',
            'Phone',
            [
                'attribute' => 'Score',
                'format' => 'raw',
                'value' => function($model){
                    return $model->Score / 100;
                }
            ],
            'CreateDate',
        ],
    ]) ?>

</div>
