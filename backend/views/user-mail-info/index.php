<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserMailInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Mail Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-mail-info-index">

    <p>
        <?= Html::a(Yii::t('app', 'AddUser Mail Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'SysID',
            'UserID',
            'Title',
            'Content',
            'Status',
            'SendTime',
            'ExpireTime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
                'header' => 'Action',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View',$url, [
                            'class' => 'btn btn-default',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Delete',$url, [
                            'class' => 'btn btn-danger',
                            'data-confirm'=>"Are you sure you want to delete this item?",
                            'data-method'=>"post",
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Update',$url, [
                            'class' => 'btn btn-primary',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
