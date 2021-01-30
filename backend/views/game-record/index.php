<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GameRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Game Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-record-index">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
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
                <th>RcdId</th>
                <th>Turns</th>
                <th>GameName</th>
                <th>RoomId</th>
                <th>PlyNum</th>
                <th>Tax</th>
                <th>SysWin</th>
                <th>Procedure</th>
                <th>TimeCost</th>
                <th>BeginTime</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['RcdId'].$val['Turns']?>">
                    <td><?=$val['RcdId']?></td>
                    <td><?=$val['Turns']?></td>
                    <td><?=$val['GameName']?></td>
                    <td><?=$val['RoomId']?></td>
                    <td><?=$val['PlyNum']?></td>
                    <td><?=$val['Tax']/100 ?></td>
                    <td><?=$val['SysWin']/100 ?></td>
                    <td><?= 'ww' ?></td>
                    <td><?= $val['TimeCost'] ?></td>
                    <td><?= $val['BeginTime'] ?></td>
                    <td><?=html::a('ViewPlayerInfo',"/game-record-player/index?GameRecordPlayerSearch[RcdId]={$val['RcdId']}&GameRecordPlayerSearch[Turns]={$val['Turns']}", ['class' => 'btn btn-primary'])?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>

</div>
