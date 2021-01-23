<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserCouponInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Coupon Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-coupon-info-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>UserID</th>
                <th>NickName</th>
                <th>Type</th>
                <th>Status</th>
                <th>UsedTime</th>
                <th>CreateTime</th>
                <th>ExpireTime</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['ID']?></td>
                    <td><?=$val['UserID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?=$val['Type']?></td>
                    <td><?= [$val['Status']] == 1 ? '已使用': '未使用' ?></td>
                    <td><?=$val['UsedTime']?></td>
                    <td><?=$val['CreateTime']?></td>
                    <td><?=$val['ExpireTime']?></td>
                    <td ><?php echo Html::a('Delete',"/user-invite-info/delete?id=".$val['ID'], [
                            'class' => 'btn btn-danger',
                            'data-confirm'=>"Are you sure you want to delete this item?",
                            'data-method'=>"post",
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
