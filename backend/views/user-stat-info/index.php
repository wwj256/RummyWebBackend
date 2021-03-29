<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserStatInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Stat Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-stat-info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UserID',
            'TPayScore',
            'TPayCnt',
            'TDrawScore',
            'TDrawCnt',
            //'TGameCnt',
            //'TBrokeUp',
            //'TWinScore',
            //'TLostScore',
            //'TPointCnt',
            //'TPoolCnt',
            //'TDealCnt',
            //'TPoint10Cnt',
            //'TMatchCnt',
            //'TTicketScore',
            //'TAssistScore',
            //'TInviteScore',

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
