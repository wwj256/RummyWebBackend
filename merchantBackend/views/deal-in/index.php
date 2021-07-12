<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Transfer to daily statistics';
?>
<style>
    tr th{
        text-align: center;
        max-width: 100px;
    }
</style>
<div class="deal-in-index">
    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        
        <?php 
            $count = count($dataProvider);
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
            <tr style="text-align: center;">
                <th>Date</th>
                <th>Transferred Gold</th>
                <th>Check the details</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($dataProvider as $val){  ?>
                <tr data-key="<?=$val['time']?> " style="text-align: center;">
                    <td><?=$val['time']?></td>
                    <td><?=$val['score']?></td>
                    <td><?php
                        echo Html::a($val['count'],'/log-deal/index?LogDealSearch[Type]=0&LogDealSearch[UpdateTime]='.$val['time']);
                        ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'first', 'lastPageLabel' => 'last', 'hideOnSinglePage' => false ]); ?>
    </div>

</div>