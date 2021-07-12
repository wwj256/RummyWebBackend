<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;

class TradeInLogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $uid = Yii::$app->request->getQueryParam("id");
        
        $homeData = [];
        $homeData['userID'] = $uid;
        
        $whereContidion = '';
        if( $uid ){
            $whereContidion = "WHERE UserID = $uid ";
        }
        //总数据条数
        $statisticsSql = "SELECT ID FROM lami_deal.log_admin_trade $whereContidion";
        $dataProvider = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $count = count($dataProvider);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '50']);
        $offset = $pages->offset;

        $statisticsSql = "SELECT * FROM lami_deal.log_admin_trade $whereContidion Order BY UpdateTime DESC LIMIT 50 OFFSET $offset";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
                ->queryAll();
        if( !$statisticsData ){
            $homeData['error'] = '未找到币商，请重新输入！';
        }else{
            $homeData['error'] = '';
        }

        return $this->render('index',[
            'dataProvider' => $statisticsData,
            'pages' => $pages,
            'homeData' => $homeData,
        ]);
    }
}
