<?php

namespace merchantBackend\controllers;

use backend\models\UserDeal;
use common\components\HttpTool;
use merchantBackend\models\LogDeal;
use Yii;

class DealController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 
     * type，0:扣除用户金币，1:转给用户金币
     */
    public function actionDeal($type, $targetID, $score, $phone, $code)
    {
        $uid = \Yii::$app->user->identity->getId();
        $userDeal = UserDeal::findIdentity($uid);
        if( $type == 0 ){
            $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/checksms?ph=$phone&cd=$code");
            $serverRespon = json_decode($serverResponStr);
            if( $serverRespon->code != 0 ){
                return 'SMS code error!';
            }
            
            $sqlStr = "SELECT * lami_account.score_info WHERE UserID = $targetID;";
            $sqlData = Yii::$app->db->createCommand($sqlStr)
                ->queryOne();
            if( !$sqlData ){
                return "The user's game ID was not found, please enter it again！";//用户游戏ID未到找，请重新输入
            }else{
                if( $sqlData['Score'] - $sqlData['BindScore'] < ($score * 100)){
                    return 'The user is short of gold coins, please contact the user';//'用户的金币不足，请与用户联系！';
                }
            }
            $score = $score * -100;
        }else{
            $score = $score * 100;
            if( $userDeal->Score < $score ){
                return 'You are currently short of gold coins!';
            }
        }
        
        $model = new LogDeal();
        $model->UserID = $uid;
        $model->Type = $type;
        $model->Score = $userDeal->Score;
        $model->DealScore = $score * -1;
        $model->TargetID = $targetID;
        $model->TargetPhone = $phone;
        
        //向服务器发送消息，通知给用户加币
        $serverResponStr = HttpTool::doGet(Yii::$app->params['ServerURL']."addscore?userid={$targetID}&score={$score}&stype=9&relateid=$uid");
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return "User deal error code=$serverRespon->CODE, ".Yii::$app->params['errorCode'][$serverRespon->CODE];
            }
        }else{
            return 'User deal error';
        }

        $statisticsSql = "UPDATE lami_deal.user_deal SET Score=Score+$model->DealScore WHERE UserID = $uid;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->execute();
        if( !$statisticsData ){
            return 'User deal success，trade deal error！';
        }
        if( $type == 0 ){
            $serverResponStr = HttpTool::doGet(Yii::$app->params['ApiURL']."houtai/delsms??ph={$phone}");
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
        $statisticsSql = "SELECT NickName, Score FROM lami_account.account_info as account , lami_account.score_info as scoreInfo WHERE account.UserID = scoreInfo.UserID AND account.UserID = $id";
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
        $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/sendsms?ph={$phone}");
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon->code != 0 ){//服务器加币如果不成功，打印错误内容
            return "Send SMS error code=$serverRespon->code, ".Yii::$app->params['errorCode'][$serverRespon->code];
        }
        return "1";
    }

}
