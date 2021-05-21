<?php

namespace console\controllers;

use common\components\GFTool;
use Yii;
use yii\console\Controller;

class DemoController extends Controller
{
    public function actionTest()
    {
        echo 'Test controller hello world'.date("r").'\n';
        //总注册人数
        $statisticsSql = "INSERT INTO lami_backend.test VALUES ();";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->execute();

        GFTool::writeLog('test controller '.date("r"));
    }
}