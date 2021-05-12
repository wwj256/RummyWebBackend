<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GameRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Game Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-room-index">
    <script>
        /**
         * 更新订单状态
         * @param x
         * @param gid
         */
        function updateStatus(x, dsn)
        {
            $.post("/game-room/update-state?id="+dsn+"&value="+x.selectedIndex,function (data){alert(data)});
        }
        /**
         * 更新严选商品列表
         * @param x
         * @param gid
         */
        function changeDeliveryno(x, type, pid)
        {
            $.post("/room-control/update-value?id=" + pid + "&type=" + type + "&value="+(x.value*100),function (data){
                // if( data == '修改成功'){
                //     x.disabled='true';
                // }
                alert(data);
            });
        }
    </script>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Game Room'), ['create'], [
        'class' => 'btn btn-success',
        'id' => 'create',
        'data-toggle' => 'modal',
        'data-target' => '#operate-modal',
        ]) ?>
    </p>

    <div id="p0" class="grid-view" >
        <?php 
            $count = count($model);
            $totalCount = $pages->totalCount;
            $begin = $pages->getPage() * $pages->getPageSize() + 1;
            $end = $begin + $count - 1;
            if ($begin > $end) {
                $begin = $end;
            }          
            echo "Showing <b>$begin-$end</b> of <b>$totalCount</b> items.";                
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>RoomID</th>
                <th>RealGameID</th>
                <th>RoomName</th>
                <th>RoomStatus</th>
                <th>IsPractice</th>
                <th>HaveRobot</th>
                <th>ActivPlayer</th>
                <th>InitScore</th>
                <th>Score</th>
                <th>MaxScore</th>
                <th>MaxPlayer</th>
                <th>Blind</th>
                <th>MinEntry</th>
                <th>EntryFee</th>
                <th>Prize</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){ $roomConfig = json_decode($val['ConfJson']);  ?>
                <tr data-key="<?=$val['RoomID']?>">
                    <td><?=$val['RoomID']?></td>
                    <td><?=$val['RealGameID']?></td>
                    <td><?= $roomConfig->RoomName ?></td>
                    <td><?= Html::dropDownList($val['RoomStatus'], $val['RoomStatus'], [0=>'Open',1=>'Close'], ['onchange'=>'
                        updateStatus(this,'. $val['RoomID'].')'
                        ]); ?></td>
                    <td><?= $roomConfig->IsPrac == 1 ? 'yes' : 'no' ?></td>
                    <td><?= $val['HaveRbt'] == 1 ? 'Open' : 'Close' ?></td>
                    <td><?= $val['ActivPlayer'] ?></td>
                    <td><?= Html::textInput("text1", $val['MinScore']/100, ['id' => 'text1', 'style' => 'width:70px','placeholder'=>'输入运单号','onchange'=>'
                        changeDeliveryno(this,"MinScore",'. $val['RoomID'].')']); ?></td>
                    <td><?= Html::textInput("text2", $val['Score']/100, ['id' => 'text2', 'style' => 'width:70px','placeholder'=>'输入运单号','onchange'=>'
                        changeDeliveryno(this,"Score",'. $val['RoomID'].')']); ?></td>
                    <td><?= Html::textInput("text3", $val['MaxScore']/100, ['id' => 'text3', 'style' => 'width:70px','placeholder'=>'输入运单号','onchange'=>'
                        changeDeliveryno(this,"MaxScore",'. $val['RoomID'].')']); ?></td>
                    <td><?= $roomConfig->MaxPlayer ?></td>
                    <td><?= $roomConfig->Blind/100 ?></td>
                    <td><?= $roomConfig->MinEntry/100 ?></td>
                    <td><?= $roomConfig->EntryFee/100 ?></td>
                    <td><?= $roomConfig->Prize/100 ?></td>
                    <td ><?php echo html::a('View','view?id='.$val['RoomID'], ['class'=>"btn btn-default"]);
                        echo html::a('Update', 'update?id='.$val['RoomID'], ['class'=>"btn btn-primary"]);
                        echo html::a('Delete', 'deleate?id='.$val['RoomID'], ['class'=>"btn btn-danger",'data-confirm'=>"Are you sure you want to delete this item?",
                            'data-method'=>"post",]) ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'first', 'lastPageLabel' => 'last', 'hideOnSinglePage' => false ]); ?>
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
