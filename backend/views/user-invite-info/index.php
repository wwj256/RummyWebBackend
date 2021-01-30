<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserInviteInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Invite Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invite-info-index">

    <p>
        <?= Html::a(Yii::t('app', 'AddUser Invite Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UserID',
            'MyInviter',
            'InviteCounts',
            'TotalBonus',
            'InviteBonus',
            'DepositBonus',
            'TodayOutBonus',
            'TotalOutBonus',
            'RecordTime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn('{view} '),
                'header' => 'Action',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View',$url, [
                            'class' => 'btn btn-default',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
