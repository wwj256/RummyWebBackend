<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-log-index">

    <p>
        <?= Html::a('添加Admin Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
                'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'route',
            [
                'attribute'=>'created_at',
                'format'=>'raw',
                'value'=>function($m){
                    return date('Y-m-d H:i:s', $m->created_at);
                },
            ],
            // [
            //     'attribute'=>'description',
            //     'format'=>'raw',
            //     'value'=>function($m){
            //         return $m->description;
            //     },
            //     'contentOptions' => ['style'=>'max-width:1000px;'],
            // ],
            'description:ntext',
            'user_id',
            //'user_name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} {update} {delete}'),
                'header' => '操作',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('详情',$url, [
                            'class' => 'btn btn-default',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除',$url, [
                            'class' => 'btn btn-danger',
                            'data-confirm'=>"您确定要删除此项吗？",
                            'data-method'=>"post",
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改',$url, [
                            'class' => 'btn btn-primary',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
