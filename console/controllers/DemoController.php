<?php

namespace console\controllers;

use common\components\GFTool;
use Yii;
use yii\console\Controller;

class DemoController extends Controller
{
    public function actionTest()
    {
        echo 'Test controller hello world';
        GFTool::writeLog('test controller '.date("r"));
    }
}