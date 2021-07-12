<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = '币商交易日志';
?>
<style>
    tr th{
        text-align: center;
        max-width: 100px;
    }
</style>
<script>

    function btnSearch(){
        let txt_1 = document.getElementById('userIDTxt').value;
        window.location.href = '/trade-log/index?id=' + txt_1;
    }
</script>
<div class="form-group ">
    <label class="form-label" style="width:auto;margin-left:10px" >UserID</label>
    <input type="text" id="userIDTxt" oninput = "value=value.replace(/[^\d]/g,'')" value="<?= $homeData['userID'] ?>" >
    <button type="button" onclick="btnSearch()" class="btn btn-primary">Search</button>
    <label id="errorLabel" class="form-label" style="width:auto;margin-left:10px;color:#f00;" ><?=  $homeData['error'] ?></label>
</div>
<div class="trade-log-index">
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
                <th>ID</th>
                <th>币商ID</th>
                <th>交易类型</th>
                <th>原金币数</th>
                <th>交易金币数</th>
                <th>交易后金币数</th>
                <th>游戏用户ID</th>
                <th>游戏用户手机号</th>
                <th>交易日期</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($dataProvider as $val){  ?>
                <tr data-key="<?=$val['ID']?> " style="text-align: center;">
                    <td><?=$val['ID']?></td>
                    <td><?=$val['UserID']?></td>
                    <td><?=$val['Type']?></td>
                    <td><?=$val['Score']/100?></td>
                    <td><?=$val['DealScore']/100?></td>
                    <th><?=($val['DealScore'] +$val['Score']) /100?></th>
                    <td><?=$val['TargetID']?></td>
                    <td><?=$val['TargetPhone']?></td>
                    <td><?=$val['UpdateTime']?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'first', 'lastPageLabel' => 'last', 'hideOnSinglePage' => false ]); ?>
    </div>

</div>