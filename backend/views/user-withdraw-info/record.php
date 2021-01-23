<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserWithdrawInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Withdraw Record');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-withdraw-info-search">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-inline'],
        'action' => ['record'],
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{label}\n{input}",
            'labelOptions' => ['class' => 'form-label','style'=>'width:auto;margin-left:10px'],
        ],
    ]); ?>

    <div class="row" style="margin: 20px 0px 20px 0px" >
        <?= $form->field($searchModel, 'ID') ?>

        <?= $form->field($searchModel, 'UserID') ?>

        <?= $form->field($searchModel, 'create_time')->label('充值日期范围')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($searchModel['create_time'])?$searchModel['create_time']:'开始日','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',

            ]
        ]); ?>
        <label class=" form-label">至</label>

        <?= $form->field($searchModel, 'end_time')->label(false)->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($searchModel['end_time'])?$searchModel['end_time']:'截至日','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="user-withdraw-info-record">



    <div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000" style="overflow: auto;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>提现ID</th>
                <th>用户ID</th>
                <th>用户昵称</th>
                <th>提现金额</th>
                <th>提现前金额</th>
                <th>税</th>
                <th>状态</th>
                <th>操作人员</th>
                <th>操作时间</th>
                <th>俱乐部等级</th>
                <th>申请时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $val){ ?>
                <tr data-key="<?=$val['ID']?>">
                    <td><?=$val['ID']?></td>
                    <td class="ids">
                        <?=html::a($val['UserID'],'javascript:;')?>
                    </td>
                    <td><?=$val['NickName']?></td>
                    <td><?=$val['Amount']/100?></td>
                    <td><?=$val['BeforeScore']/100?></td>
                    <td><?=$val['Tax']?></td>
                    <td><?= Yii::$app->params['withdrwaStatusLabels'][$val['Status']]?></td>
                    <td><?=$val['OperatorName']?></td>
                    <td><?=$val['OperatorTime']?></td>
                    <td><?=$val['ClubLV']?></td>
                    <td><?=$val['CreateTime']?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>