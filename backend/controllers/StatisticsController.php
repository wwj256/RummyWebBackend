<?php

namespace backend\controllers;
use Yii;

class StatisticsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $homeData = [];
        $todayTimeStr = date("Y-m-d");
        //总注册人数
        $statisticsSql = "SELECT COUNT(*) as count FROM lami_account.account_info WHERE IsRobot = 0;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['allRegisterCount'] = $statisticsData['count'];
        //总充值
        $statisticsSql = "SELECT SUM(Amount) as count FROM lami_account.user_order_info WHERE Status = 1;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['TotalDepositors'] = $statisticsData['count'];
        //总税收
        $statisticsSql = "SELECT COUNT(*) as count FROM lami_account.account_info WHERE IsRobot = 0;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['TotalRake'] = $statisticsData['count'];


        

        //1个月内的登录的账号数
        // $statisticsSql = "SELECT COUNT(DISTINCT UID) as count FROM lami_record.user_login_out WHERE IsLogin = 1 AND UpdateTime > '2021-04-01 10:17:30';";
        // $statisticsData = Yii::$app->db->createCommand($statisticsSql)
        //     ->queryOne();
        // $homeData['ActiveLoginPlayers'] = $statisticsData['count'];

        //1个月内的玩游戏的账号数
        $statisticsSql = "SELECT COUNT(DISTINCT UID) as count FROM lami_record.game_record_player WHERE UID > 9999 AND DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(BeginTime);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['ActiveRealPlayers'] = $statisticsData['count'];

        //1个月内的充值账号数
        $statisticsSql = "SELECT COUNT(DISTINCT UserID) as count FROM lami_account.user_order_info WHERE Status = 1 AND DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(CreateTime);";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['ActiveDepositingPlayers'] = $statisticsData['count'];

        //当前月的新注册账号数
        $statisticsSql = "SELECT COUNT(DISTINCT UserID) as count FROM lami_account.account_info WHERE UserID > 9999 AND DATE_FORMAT( RegisterDate, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' );";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['NewRegistrations'] = $statisticsData['count'];

        //当前月首充账号数

        //当前月总充值
        $statisticsSql = "SELECT SUM(Amount) as count FROM lami_account.user_order_info WHERE Status = 1 AND DATE_FORMAT( CreateTime, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m');";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        $homeData['CurrentMontyTotalDepositors'] = $statisticsData['count'];


        return $this->render('index', [
            'homeData' => $homeData,
        ]);
    }

}
