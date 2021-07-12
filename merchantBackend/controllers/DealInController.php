<?php

namespace merchantBackend\controllers;

use Yii;
use yii\data\Pagination;

class DealInController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $uid = \Yii::$app->user->identity->getId();

        //每天的数据
        $statisticsSql = "SELECT DATE_FORMAT(UpdateTime,'%Y-%m-%d') as time FROM lami_deal.log_deal WHERE Type = 0 AND UserID = $uid  GROUP BY time";
        $dataProvider = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $count = count($dataProvider);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '50']);
        $offset = $pages->offset;
        // echo $offset;
        //每天的数据
        $statisticsSql = "SELECT DATE_FORMAT(UpdateTime,'%Y-%m-%d') as time, COUNT(UserID) as count, SUM(DealScore) as score FROM lami_deal.log_deal WHERE Type = 0 AND UserID = $uid GROUP BY time ORDER BY time DESC LIMIT 50 OFFSET $offset;";
        $dataProvider = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();

        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }

}
