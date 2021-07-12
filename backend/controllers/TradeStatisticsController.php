<?php

namespace backend\controllers;

use Yii;

class TradeStatisticsController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $uid = Yii::$app->request->getQueryParam("id");
        
        $homeData = [];
        $homeData['userID'] = $uid;
        
        $whereCondition = '';
        if( $uid ){
            $whereCondition = "AND UserID = $uid";

            $statisticsSql = "SELECT Score FROM lami_deal.user_deal WHERE UserID = $uid";
            $statisticsData = Yii::$app->db->createCommand($statisticsSql)
                ->queryOne();
        }else{
            $statisticsSql = "SELECT Score FROM lami_deal.user_deal";
            $statisticsData = Yii::$app->db->createCommand($statisticsSql)
                ->queryOne();
        }
        if( !$statisticsData ){
            $homeData['curCount'] = 0;
            $homeData['error'] = '未找到币商，请重新输入！';
        }else{
            $homeData['curCount'] = $statisticsData['Score'];
            $homeData['error'] = '';
        }

        
        //总转入
        $statisticsSql = "SELECT SUM(DealScore) as score FROM lami_deal.log_deal WHERE Type = 0 $whereCondition";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['buyCount'] = $statisticsData['score'];
        
        //总卖出
        $statisticsSql = "SELECT SUM(DealScore) as score FROM lami_deal.log_deal WHERE Type = 1 $whereCondition";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['sellCount'] = $statisticsData['score'];;
        //每天的数据
        //1个月内的每天的数据
        $statisticsSql = "SELECT DATE_FORMAT(UpdateTime,'%Y-%m-%d') as time, SUM(DealScore) as score FROM lami_deal.log_deal WHERE Type = 0 $whereCondition AND DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(UpdateTime) GROUP BY time";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $dealInData = [];
        foreach ($statisticsData as $key => $value) {
            $dealInData[substr($value['time'],5,5)] = $value['score'];
        }


        $statisticsSql = "SELECT DATE_FORMAT(UpdateTime,'%Y-%m-%d') as time, SUM(DealScore) as score FROM lami_deal.log_deal WHERE Type = 1 $whereCondition AND DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(UpdateTime) GROUP BY time";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $dealOutData = [];
        foreach ($statisticsData as $key => $value) {
            $dealOutData[substr($value['time'],5,5)] = $value['score'];
        }
        // echo json_encode($dealInData);
        $chatLabels = [];
        $chatDatasIn = [];
        $chatDatasOut = [];
        for ($i=1; $i < 31; $i++) { 
            $dateStr = substr(date("Y-m-d",strtotime("-$i day")),5,5);
            array_unshift($chatLabels,$dateStr);
            if( array_key_exists($dateStr, $dealInData) ){
                array_unshift($chatDatasIn,$dealInData[$dateStr]);
            }else{
                array_unshift($chatDatasIn,0);
            }
            if( array_key_exists($dateStr, $dealOutData) ){
                array_unshift($chatDatasOut,abs($dealOutData[$dateStr]));
            }else{
                array_unshift($chatDatasOut,0);
            }
        }
        // echo json_encode($chatLabels);
        // echo json_encode($chatDatasIn);
        // echo json_encode($chatDatasOut);

        //总数据
        // $statisticsSql = "SELECT COUNT(oid) as count, SUM(amount) as amount FROM apiorder WHERE uid=$uid AND ostate = 0";
        // $statisticsData = Yii::$app->db->createCommand($statisticsSql)
        //     ->queryOne();

        // //每天的数据
        // $statisticsSql = "SELECT DATE_FORMAT(createtime,'%Y-%m-%d') as time, COUNT(oid) as count, SUM(amount) as amount FROM apiorder WHERE uid=$uid AND ostate = 0 GROUP BY createtime ORDER BY createtime DESC;";
        // $statisticsDayData = Yii::$app->db->createCommand($statisticsSql)
        //     ->query();

//        //今天的数据
//        $statisticsSql = "SELECT COUNT(oid) as count, SUM(amount) as amount FROM apiorder WHERE uid=$uid AND ostate = 1 AND TO_DAYS(createtime) = TO_DAYS(NOW())";
//        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
//            ->query();
//        array_push($result,$statisticsData);
//
//        //昨天的数据
//        $statisticsSql = "SELECT COUNT(oid) as count, SUM(amount) as amount FROM apiorder WHERE uid=$uid AND ostate = 1 AND TO_DAYS(NOW()) - TO_DAYS(createtime) <=1";
//        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
//            ->query();
//        array_push($result,$statisticsData);
//
//        //近三天的
//        $statisticsSql = "SELECT * FROM apiorder WHERE uid=$uid AND ostate = 1 AND DATE_SUB(CURDATE(),INTERVAL 3 DAY) <= DATE(createtime)";
//        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
//            ->query();
//        array_push($result,$statisticsData);
//
//        //近七天的
//        $statisticsSql = "SELECT * FROM apiorder WHERE uid=$uid AND ostate = 1 AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= DATE(createtime)";
//        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
//            ->query();
//        array_push($result,$statisticsData);
        return $this->render('index', [
            // 'statisticsData' => $statisticsData,
            // 'statisticsDayData' => $statisticsDayData,
            'homeData' => $homeData,
            'chatLabels' => json_encode($chatLabels),
            'chatDatasIn' => json_encode($chatDatasIn),
            'chatDatasOut' => json_encode($chatDatasOut),

        ]);
    }

}
