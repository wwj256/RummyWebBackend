<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserActionStatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Action Stats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-action-stat-index" style="width: 100%;overflow: auto;">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UniqueID',
            'UID',
            'Loading',
            'Lobby',
            'NewGuide',
            'FinishGuide',
            'EnterPractise',
            'EnterGold',
            'FinishGame',
            'BrakeUp',
            'BrakeOpenPayWeb',
            'BrakeOpenActivity',
            'OpenDraw',
            'OpenVip',
            'OpenShare',
            'NetBrake',
            'CreateDate',
        ],
    ]); ?>


</div>
<?
