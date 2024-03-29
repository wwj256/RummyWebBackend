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

        <?= $form->field($searchModel, 'create_time')->label('CreateTime')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($searchModel['create_time'])?$searchModel['create_time']:'Start date','readonly'=>'readonly'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn'=>true,
                'format'=>'yyyy-mm-dd hh:ii:ss',

            ]
        ]); ?>
        <label class=" form-label">-</label>

        <?= $form->field($searchModel, 'end_time')->label(false)->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => isset($searchModel['end_time'])?$searchModel['end_time']:'End date','readonly'=>'readonly'],
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
                <th>ID</th>
                <th>UserID</th>
                <th>UserName</th>
                <th>Amount</th>
                <th>BeforeScore</th>
                <th>Tax</th>
                <th>Status</th>
                <th>OperatorID</th>
                <th>OperatorTime</th>
                <th>CreateTime</th>
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
                    <td><?=$val['Tax']/100?></td>
                    <td><?= Yii::$app->params['withdrawStatusLabels'][$val['Status']]?></td>
                    <td><?=$val['OperatorID']?></td>
                    <td><?=$val['OperatorTime']?></td>
                    <td><?=$val['CreateTime']?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pages, 'nextPageLabel' => false, 'prevPageLabel' => false, 'firstPageLabel' => 'First', 'lastPageLabel' => 'Last', 'hideOnSinglePage' => false ]); ?>
    </div>
</div>