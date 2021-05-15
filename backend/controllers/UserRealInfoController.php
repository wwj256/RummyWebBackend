<?php

namespace backend\controllers;

use backend\models\AccountInfo;
use backend\models\ScoreInfo;
use backend\models\SysConfig;
use backend\models\UserInviteLog;
use backend\models\UserInviteStat;
use common\components\HttpTool;
use Yii;
use backend\models\UserRealInfo;
use backend\models\UserRealInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\data\Pagination;
/**
 * UserRealInfoController implements the CRUD actions for UserRealInfo model.
 */
class UserRealInfoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserRealInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('UserRealInfoSearch');
        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        $query = UserRealInfo::find()
            ->select('user_real_info.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere([
            'user_real_info.UserID' => $UserID
        ]);
        $query->orderBy('RecordTime DESC');
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new UserRealInfoSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single UserRealInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserRealInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
$model = new UserRealInfo();
if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['index']);
} else {
return $this->render('create', [
'model' => $model,
]);
}
}
/**
* 异步校验表单模型,Asynchronously validate the form model
*/
public function actionValidateForm()
{
$model = new UserRealInfo();
$model->load(Yii::$app->request->post());
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return \yii\widgets\ActiveForm::validate($model);
}
    /**
     * Updates an existing UserRealInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::toRoute('index'));
        } else {
            return $this->render('update', [
            'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserRealInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRealInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRealInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRealInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * 修改状态
     * @param $id   ID
     * @param $value    状态
     * @param null $desc    描述
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionChangeStates($id, $value, $desc=null)
    {
        $model = $this->findModel($id);
//        return Yii::$app->runAction('acctemail/add-mail',['id'=>$id,'title'=>"承兑商审核结果", 'content'=>'恭喜您，您的承兑商申请已审核通过，谢谢您的支持！']);
        if( $model->Status  == $value ){
           return 'change complete';
        }
        $changeTypeSucess = true;
//        if( $desc ) $model->Desc = $desc;
        //向服务器发送消息，修改用户数据，将实名状态改为true,值为1，
        $url = Yii::$app->params['ServerURL']."kyc?userid={$id}&realreg=$value";
        $serverResponStr = HttpTool::doGet($url);
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return 'update account realreg state fail, errorCode='.$serverRespon->CODE;
            }
        }else{
            return 'update account realreg state fail, ERR_CONNECTION_REFUSED';
        }
        if( $value == 2 ){//2表示通过
            $sysConfig_kyc_real_add_my = SysConfig::findOne('kyc_real_add_my');
            //金币变化日志模型
            $scoreChangeModel = Yii::$app->runAction('user-score-change/get-add-model',['UID'=>$id,'SType'=>"6", 'BindChg'=>"{$sysConfig_kyc_real_add_my->V}"]);
            $scoreChangeModel->save();
            //向服务器发送消息，通知给用户加币
            $serverResponStr = HttpTool::doGet(Yii::$app->params['ServerURL']."addscore?userid={$id}&score={$sysConfig_kyc_real_add_my->V}&bindscore={$sysConfig_kyc_real_add_my->V}&stype=6");
            $serverRespon = json_decode($serverResponStr);
            if( $serverRespon ){
                if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                    return 'add gold fail, errorCode='.$serverRespon->CODE;
                }
            }else{
                return 'add gold fail, ERR_CONNECTION_REFUSED';
            }

//            echo $url.$serverResponStr;

            //服务器加币成功后，金币变化日志模型保存日志数据
            $changeTypeSucess = $scoreChangeModel->save();

            $acctModel = AccountInfo::findOne($id);
            if( $acctModel->InviteID != 0 ){
                //添加KYC实名认证后的邀请日志
                $inviteLogModel = new UserInviteLog();
                $inviteLogModel->loadDefaultValues();
                $inviteLogModel->UserID = $id;
                $inviteLogModel->InviteUID = $acctModel->InviteID;
                $inviteLogModel->OutBonus = $sysConfig_kyc_real_add_my->V;
                $inviteLogModel->save();

                //添加或修改邀请日统计表，有数据则更新，无则添加一条
                $sysConfig_kyc_real_add_parent = SysConfig::findOne('kyc_real_add_parent');
                $todayStr = date("Y-m-d");
                $inviteStatModel = UserInviteStat::findOne(['UID' => $id, 'DayStat' => $todayStr]);
                if( $inviteStatModel ){
                    $sqlStr = "update lami_record.user_invite_stat set TotalBonus=TotalBonus+{$sysConfig_kyc_real_add_parent->V},InviteBonus=InviteBonus+{$sysConfig_kyc_real_add_parent->V} where UID={$id} AND DayStat='{$todayStr}'";
                }else{
                    $sqlStr = "insert into lami_record.user_invite_stat set UID=$id,DayStat='$todayStr',TotalBonus=TotalBonus+{$sysConfig_kyc_real_add_parent->V},InviteBonus=InviteBonus+{$sysConfig_kyc_real_add_parent->V}";
                }
                Yii::$app->db->createCommand($sqlStr)
                    ->execute();
            }
        }
        $model->Status = $value;
        if($changeTypeSucess && $model->save() ){

//            HttpTool::doGet(Yii::$app->params['APIUrlSocket']."ustd/public/index.php/trade/sendaddr?omniid=$id&bk=".GFTool::getBasicConfigValue('"bktoken"'));
            if( $value == 2 ){
                Yii::$app->runAction("user-mail-info/add-mail", ['UserID'=>$id,'Title'=>"KYC Certification",'Content'=>"KYC Application：{$model->RecordTime}\nCongratulations, your KYC certification has been approved.\nThank you for playing Rummy Genius."]);
            }else{
                Yii::$app->runAction("user-mail-info/add-mail", ['UserID'=>$id,'Title'=>'KYC Certification','Content'=>"KYC Application：{$model->RecordTime}\nYour KYC authentication failed, please fill in the KYC information correctly, if you have any questions, please contact customer service.\nThank you for playing Rummy Genius."]);
            }
            return 'change complete';
        }else{
            return 'change error';
        }
    }
}
