<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserBindInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Bind Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bind-info-index">

    <h1><?=Html::encode($this->title) ?></h1>
    <?php// echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Bind Info'), ['create'], [
        'class' => 'btn btn-success',
        'id' => 'create',
        'data-toggle' => 'modal',
        'data-target' => '#operate-modal',
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UserID',
            'UniqueID',
            'Phone',
            'FacebookID',
            'Mail',
            //'GoogleID',
            //'RealName',
            //'PayName',
            //'PayPhone',
            //'PayEmail:email',


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
<?php // create modal
Modal::begin([
'id' => 'operate-modal',
'header' => '<h4 class="modal-title"></h4>',
]);
Modal::end();
// update
$requestCreateUrl = Url::toRoute('create');
// update
$requestUpdateUrl = Url::toRoute('update');
$js = <<<JS
// create action
$('#create').on('click', function () {
$('.modal-title').html('Create');
$.get('{$requestCreateUrl}',
function (data) {
$('.modal-body').html(data);
}
);
});
// update action
$('.btn-update').on('click', function () {
$('.modal-title').html('Info');
$.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
function (data) {
$('.modal-body').html(data);
}
);
});
JS;
$this->registerJs($js);
?>
