<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserLoginOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Login Outs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login-out-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>UserID</th>
                <th>NickName</th>
                <th>IsLogin</th>
                <th>SpreadID</th>
                <th>IsNew</th>
                <th>OnTime</th>
                <th>UpdateTime</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){  ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['ID']?></td>
                    <td><?=$val['UID']?></td>
                    <td><?=$val['NickName']?></td>
                    <td><?= $val['IsLogin'] == 1 ? 'LogOut' : 'LogIn' ?></td>
                    <td><?=$val['SpreadID']?></td>
                    <td><?=$val['IsNew'] ?></td>
                    <td><?=$val['OnTime'] ?></td>
                    <td><?=$val['UpdateTime'] ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>

</div>
