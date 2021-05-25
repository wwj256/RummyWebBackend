<?php

namespace console\controllers;

use backend\controllers\DayReportController;
use common\components\GFTool;
use Yii;
use yii\console\Controller;
use yii\helpers\Json;

class DayReportcmdController extends Controller
{
    public function actionTest()
    {
        echo 'Test controller hello world'.date("r").'\n';
        $todayTimeStr = '2021-03-31';
        //总注册人数
        $statisticsSql = "SELECT * FROM lami_record.day_report WHERE DayDate = $todayTimeStr;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();
        echo Json::encode($statisticsData);
        if( $statisticsData ){
            echo 'OK';
        }else{
            echo 'error';
        }

        // GFTool::writeLog('test controller '.date("r"));
    }
    /**
     * 添加今日日报表数据，第天的23:59分，统计下今日数据，添加到日报表中
     */
    public function actionAddDayReport()
    {
        $todayTimeStr = date("Y-m-d");
        DayReportController::updateDayReport($todayTimeStr);
    }
    /**
     * 初始化日报表数据，统计下表中从开始到现在的每日数据
     */
    public function actionInitDayReport()
    {
        echo 'test';
    }    

    public function actionUpdateDayReport($dayTime)
    {
        DayReportController::updateDayReport($dayTime);
    }
}