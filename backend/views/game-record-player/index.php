<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GameRecordPlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Game Record Players');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-record-player-index">

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
                <th>UID</th>
                <th>NickName</th>
                <th>isNewUser</th>
                <th>SpreadID</th>
                <th>BeginScore</th>
                <th>WinScore</th>
                <th>Bind</th>
                <th>BindChg</th>
                <th>Bonus</th>
                <th>BonusChg</th>
                <th>PlyTax</th>
                <th>BrokeUp</th>
                <th>BeginTime</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['UID'].$val['RcdId'].$val['Turns']?>">
                    <td><?=$val['RcdId']?></td>
                    <td><?=$val['Turns']?></td>
                    <td><?=$val['UID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?= $val['NewUser'] == 1 ? 'New' : 'Old' ?></td>
                    <td><?=$val['SpreadID']?></td>
                    <td><?=$val['BeginScore']/100 ?></td>
                    <td><?=$val['WinScore']/100 ?></td>
                    <td><?=$val['Bind']/100 ?></td>
                    <td><?=$val['BindChg']/100 ?></td>
                    <td><?=$val['Bonus']/100 ?></td>
                    <td><?=$val['BonusChg']/100 ?></td>
                    <td><?= $val['PlyTax']/100 ?></td>
                    <td><?= $val['BrokeUp'] ?></td>
                    <td><?= $val['BeginTime'] ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'first', 'lastPageLabel' => 'last', 'hideOnSinglePage' => false ]); ?>
    </div>

</div>
