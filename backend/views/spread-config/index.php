<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpreadConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Spread Configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spread-config-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Spread Config'), ['create'], [
        'class' => 'btn btn-success',
        'id' => 'create',
        'data-toggle' => 'modal',
        'data-target' => '#operate-modal',
        ]) ?>
    </p>
    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>SpreadID</th>
                <th>适配版本号</th>
                <th>ApkUrl</th>
                <th>HotUrl</th>
                <th>PageUrl</th>
                <th>Notice</th>
                <th>CurVersion</th>
                <th>UpdateMode</th>
                <th>ApkVersion</th>
                <th>PacketUrl</th>
                <th>Conf</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['ID']?></td>
                    <td><?=$val['SpreadID']?></td>
                    <td><?=$val['RegVersion']?></td>
                    <td><?=$val['ApkUrl']?></td>
                    <td><?=$val['HotUrl']?></td>
                    <td><?=$val['PageUrl']?></td>
                    <td><?=$val['Notice']?></td>
                    <td><?=$val['CurVersion']?></td>
                    <td><?=$val['UpdateMode']?></td>
                    <td><?=$val['ApkVersion']?></td>
                    <td><?=$val['PacketUrl']?></td>
                    <th><?=$val['Conf']?></th>
                    <td><?php
                        echo Html::a('View','/spread-config/view?id='.$val["ID"], [
                            'class' => 'btn btn-default',
                        ]);
                        echo Html::a('Delete','/spread-config/delete?id='.$val["ID"], [
                            'class' => 'btn btn-danger',
                            'data-confirm'=>"Are you sure you want to delete this item?",
                            'data-method'=>"post",
                        ]);
                        echo Html::a('Update','/spread-config/update?id='.$val["ID"], [
                            'class' => 'btn btn-primary',
                        ]);
                        ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>
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
