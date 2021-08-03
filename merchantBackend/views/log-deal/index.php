<?php
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel merchantBackend\models\LogDealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaction Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-deal-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            // 'UserID',
            [
                "attribute"=>"Type",
                "format" => "raw",
                "value" => function($model){
                    if( $model->Type == 1 ){
                        return "Give the user bluegem";
                    }else{
                        return "Deduct user bluegem";
                    }
                },

            ],
            [
                "attribute" => "Score",
                "format" => 'raw',
                'value' => function($model){
                    return $model->Score/100;
                },
            ],
            [
                "attribute" => "DealScore",
                "format" => 'raw',
                'value' => function($model){
                    return $model->DealScore/100;
                },
            ],
            [
                "attribute" => "Post-Transaction Balance",
                "format" => 'raw',
                'value' => function($model){
                    return ($model->DealScore + $model->Score)/100;
                },
            ],
            'TargetID',
            [
                "attribute" => "TargetPhone",
                "format" => "raw",
                "value" => function($model){
                    return $model->TargetPhone ? $model->TargetPhone : "";
                },
            ],
            'UpdateTime',
        ],
    ]); ?>


</div>
