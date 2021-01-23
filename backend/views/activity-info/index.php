<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use mdm\admin\components\Helper;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActivityInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activity Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-info-index">
    <script>

        function readTextFile(file, id) {
            var rawFile = new XMLHttpRequest();
            rawFile.overrideMimeType("text/plain");
            rawFile.open("GET", file, true);
            rawFile.onreadystatechange = function() {
                if (rawFile.readyState === 4 && rawFile.status == "200") {
                    var img = document.getElementById(id);
                    img.src = rawFile.responseText;
                    console.log(id + ".src=" + rawFile.responseText);
                    // callback(rawFile.responseText);
                }
            }
            rawFile.send(null);
        }
        // readTextFile("https://test.rummyjugaad.com:18080/image/download?url=Y0XV0a3C8xMSDA1XOzI=","1");
    </script>


    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activity Info'), ['create'], [
        'class' => 'btn btn-success',
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ID',
            'Tiltle',
            [
                'attribute' => 'Url',
                'format' => 'raw',
                'value' => function($model){
                    $img_base64 = \common\components\HttpTool::doGet(Yii::$app->params['APIUrl']."image/download?url=". $model->Url);
//                    echo "<script type='text/javascript'>readTextFile('https://test.rummyjugaad.com:18080/image/download?url=$model->Url',$model->ID);</script>";
//                    return "<img id='$model->ID' >";
                    $url = Yii::$app->params['APIUrl'];
                    return "<img id='$model->ID' src={$url}image/download?url=$model->Url style='width:300px'>";
//                    return "<img id="" src="data:image/jpg/png/gif;base64,' . $img_base64 .'" >';
//                    return '';
                }
            ],
            'JumpTo',
            'StartTime',
            'EndTime',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => Helper::filterActionColumn('{view} {update} {delete}'),
            'header' => 'Action',
            'buttons' => [
            'view' => function ($url, $model, $key) {
            return Html::a('View',$url, [
            'class' => 'btn btn-default',
            ]);
            },
            'delete' => function ($url, $model, $key) {
            return Html::a('Delete',$url, [
            'class' => 'btn btn-danger',
            'data-confirm'=>"Are you sure you want to delete this item?",
            'data-method'=>"post",
            ]);
            },
            'update' => function ($url, $model, $key) {
            return Html::a('Update',$url, [
            'class' => 'btn btn-primary',
            ]);
            },
            ],
        ],
    ],
    ]); ?>


</div>