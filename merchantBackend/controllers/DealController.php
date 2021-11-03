<?php

namespace merchantBackend\controllers;

use backend\models\SysConfig;
use backend\models\UserDeal;
use common\components\HttpTool;
use merchantBackend\models\LogDeal;
use Yii;

class DealController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sysConfig = SysConfig::findOne("TradeUserMinScore");
        $tradeUserMinScore = $sysConfig["V"];
        return $this->render('index',[
            "tradeUserMinScore" => $tradeUserMinScore,
        ]);
    }

    /**
     * 
     * type，0:扣除用户金币，1:转给用户金币
     */
    public function actionDeal($type, $targetID, $score, $phone, $code)
    {

        $uid = \Yii::$app->user->identity->getId();
        $userDeal = UserDeal::findIdentity($uid);
        $serverResponStr = "";
        if( $type == 0 ){
            $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/checksms?ph=$phone&cd=$code");
            $serverRespon = json_decode($serverResponStr);
            if( !property_exists($serverRespon, 'code') ){
                return $serverResponStr;
            }
            if( $serverRespon->code != 0 ){
                return 'SMS code error!';
            }
            
            $sqlStr = "SELECT * FROM lami_account.score_info WHERE UserID = $targetID;";
            $sqlData = Yii::$app->db->createCommand($sqlStr)
                ->queryOne();
            if( !$sqlData ){
                return "The account name does not exist, please enter it again！";//用户游戏ID未到找，请重新输入
            }else{
                $sysConfig = SysConfig::findOne("TradeUserSaveMinScore");
                $userScore = $sqlData['Score'] - $sqlData['BindScore'];
                if( ($userScore - $sysConfig['V']) < ($score * 100)){
                    return 'This user has insufficient funds. Please contact the user to help resolve his issue.';//'用户的金币不足，请与用户联系！';
                }
            }
            $score = $score * -100;
            $serverResponStr = HttpTool::doGet(Yii::$app->params['ServerURL']."addscore?userid={$targetID}&score={$score}&stype=9&relateid=$uid");
        }else{
            $score = $score * 100;
            if( $userDeal->Score < $score ){
                return 'You have an insufficient balance.';
            }
            $serverResponStr = HttpTool::doGet(Yii::$app->params['ServerURL']."addscore?userid={$targetID}&score={$score}&bindscore={$score}&stype=9&relateid=$uid");
        }
        
        $model = new LogDeal();
        $model->UserID = $uid;
        $model->Type = $type;
        $model->Score = $userDeal->Score;
        $model->DealScore = $score * -1;
        $model->TargetID = $targetID;
        $model->TargetPhone = $phone;
        
        //向服务器发送消息，通知给用户加币
        $serverRespon = json_decode($serverResponStr);
        if( !property_exists($serverRespon, 'code') ){
            return $serverResponStr;
        }
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return "User Transaction Error code=$serverRespon->CODE, ".Yii::$app->params['errorCode'][$serverRespon->CODE];
            }
        }else{
            return 'User Transaction Error';
        }

        $statisticsSql = "UPDATE lami_deal.user_deal SET Score=Score+$model->DealScore WHERE UserID = $uid;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->execute();
        if( !$statisticsData ){
            return 'User deal success，trade deal error！';
        }
        if( $type == 0 ){
            $serverResponStr = HttpTool::deleteSMS($phone, 0);
        }

        //保存日志
        if( $model->save() ){
            //向服务器发送消息，通知变更

            return "1";
        }
        return 'error';
    }

    public function actionSearchInfo($id)
    {
        $statisticsSql = "SELECT NickName, Score, BindScore, Phone FROM lami_account.account_info as account , lami_account.score_info as scoreInfo, lami_account.user_bind_info as bindInfo WHERE account.UserID = scoreInfo.UserID AND account.UserID = bindInfo.UserID AND account.UserID = $id";
        $result = Yii::$app->db->createCommand($statisticsSql)
            ->queryOne();

        return json_encode($result);
    }

    public function actionChangePwd($pwd)
    {
        $uid = Yii::$app->user->identity->getId();
        $userDeal = UserDeal::findIdentity($uid);
        $md5Pwd = md5($pwd);
        $userDeal->Password = $md5Pwd;
        return $userDeal->save();
    }

    public function actionSendsms($phone)
    {
        return HttpTool::sendSMS($phone, 0);
        // $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/sendsms?ph=%2B91{$phone}");
        // $serverRespon = json_decode($serverResponStr);
        // if( $serverRespon->code != 0 ){//服务器加币如果不成功，打印错误内容
        //     return "OTP Sending Error code=$serverRespon->code, ".Yii::$app->params['errorCode'][$serverRespon->code];
        // }
        // return "1";
    }

}
