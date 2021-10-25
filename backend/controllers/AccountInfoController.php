<?php

namespace backend\controllers;

use common\components\HttpTool;
use Yii;
use backend\models\AccountInfo;
use backend\models\AccountInfoSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use moonland\phpexcel\Excel;

/**
 * AccountInfoController implements the CRUD actions for AccountInfo model.
 */
class AccountInfoController extends Controller
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
     * Lists all AccountInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('AccountInfoSearch');
        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        $login_startTime = isset($form['create_time'])?trim($form['login_startTime']):'';
        $login_endTime = isset($form['end_time'])?trim($form['login_endTime']):'';
        $NickName = isset($form['NickName'])?trim($form['NickName']):'';
        $RegisterIP = isset($form['RegisterIP'])?trim($form['RegisterIP']):'';

        $action = Yii::$app->request->get('action');
        // echo "action=".$action;

        $query = AccountInfo::find()
            ->select('account_info.*, score_info.Score,score_info.BindScore,score_info.BonusScore,score_info.LuckScore,score_info.ExpScore')
            ->joinWith("score_info");
        $query->andFilterWhere([
            'account_info.UserID' => $UserID,
            'account_info.NickName' => $NickName,
        ]);
        $query->andFilterWhere(['like', 'account_info.RegisterIP', $RegisterIP])
            ->andFilterWhere(['>=', 'RegisterDate', $create_time])
            ->andFilterWhere(['<=', 'RegisterDate', $end_time])
            ->andFilterWhere(['>=', 'LoginDate', $login_startTime])
            ->andFilterWhere(['<=', 'LoginDate', $login_endTime])
            ->orderBy('UserID DESC');
        if ($action == 'export') {
            $model = $query->asArray()->all();    
            $this->actionExport($model);
            return;
        }
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new AccountInfoSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        $uid = Yii::$app->user->identity->getId();
        $statisticsSql = "SELECT * FROM lami_backend.auth_assignment WHERE item_name = '管理员' AND user_id = $uid";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $isAdmin = count($statisticsData) > 0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Displays a single AccountInfo model.
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
     * Creates a new AccountInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccountInfo();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->UserID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AccountInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->UserID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AccountInfo model.
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
     * Finds the AccountInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddScore($id, $SChange=0, $BindChg=0, $BonusChg=0, $LuckChg=0, $ExpScore=0, $desc='')
    {
        $SChange = (int)$SChange*100;
        $BindChg = (int)$BindChg*100;
        $BonusChg = (int)$BonusChg*100;
        $LuckChg = (int)$LuckChg*100;
        $ExpScore = (int)$ExpScore;
        $score = $SChange + $BindChg;

        //管理员名称
        $adminID = Yii::$app->user->id;
        //金币变化日志模型
        // $scoreChangeModel = Yii::$app->runAction('user-score-change/get-add-model',['UID'=>$id,'SType'=>"4", 'SChange'=>$SChange,'BindChg'=>$BindChg,'BonusChg'=>$BonusChg,'LuckChg'=>$LuckChg,'Reason'=>$desc, 'RelateID'=>$adminID]);
        $url = Yii::$app->params['ServerURL']."addscore?userid={$id}&score={$score}&bindscore={$BindChg}&bindbonus={$BonusChg}&luckscore={$LuckChg}&expscore={$ExpScore}&stype=4";
        // return $url;
        //向服务器发送消息，通知给用户加币
        $serverResponStr = HttpTool::doGet($url);
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return 'add gold fail, errorCode='.$serverRespon->CODE;
            }
        }else{
            return 'add gold fail, ERR_CONNECTION_REFUSED'.$url."____".$serverRespon;
        }
        //服务器加币成功后，金币变化日志模型保存日志数据,服务器会自已添加日志，后台不用再添加日志
        // if( !$scoreChangeModel->save() ){
        //     return "filed";
        // };
        return 'add score success';
    }

    /**
     * @param $id       userID
     * @param $type     0正常,1禁止游戏和提现,2禁止登陆
     * @return string
     */
    public function actionUpdateState($id, $status)
    {
        $url = Yii::$app->params['ServerURL']."userstate?userid={$id}&state={$status}";
        //向服务器发送消息，通知修改用户状态
        $serverResponStr = HttpTool::doGet($url);
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return 'Update state fail, errorCode='.$serverRespon->CODE;
            }
        }else{
            return 'Update state fail, ERR_CONNECTION_REFUSED';
        }
        if( $status != 0 ){
            Yii::$app->runAction("user-mail-info/add-mail", ['UserID'=>$id,'Title'=>"Abnormal Account",'Content'=>"Dear player, your account has been flagged for suspicious activity. Until this is resolved, you will not be able to play/join games or withdraw any money. Please contact customer service for more information and assistance."]);
        }
        return 'Update state sucess!';
    }

        /**
     * @param $id       userID
     * @return string
     */
    public function actionUpdateMachine($id)
    {

        $model = $this->findModel($id);
        $indexSpread = strpos($model->UniqueID, '_');
        $machineStr = \common\components\GFTool::getRandom(32);

        $model->RegisterMachine = $machineStr;
        $model->UniqueID = substr($model->UniqueID, 0, $indexSpread>0 ? $indexSpread+1 : 0).$machineStr;
       // return $indexSpread.$model->UniqueID.'+++++'.$model->RegisterMachine;
        if( $model->save() ){
            return 'change success!';
        }else{
            return 'change failure!';
        }
    }

    public function actionExport($data=null)
    {
        // $form = Yii::$app->request->get('AccountInfoSearch');
        // $form = $data;
        // $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        // $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        // $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        // $SpreadID = isset($form['SpreadID'])?trim($form['SpreadID']):'';
        // $RegisterIP = isset($form['RegisterIP'])?trim($form['RegisterIP']):'';
        // echo 'UserID=';
        // echo $UserID;
        // return;
        if (!$data) {
            $query = AccountInfo::find()
            ->select('account_info.*, score_info.Score,score_info.BindScore,score_info.BonusScore,score_info.LuckScore,score_info.ExpScore')
            ->joinWith("score_info");
        
            $query->orderBy('UserID DESC');
            $data = $query->offset(0)->limit(1)->asArray()->all();
            // echo json_encode($data);
            // return;
            // $data = $query->asArray()->all();  
        }
        
//        echo json_encode($data);
//        return;
        try{
            //实例化
            $objPHPExcel = new \PHPExcel();
            //设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
            $objPHPExcel
                ->getProperties()  //获得文件属性对象，给下文提供设置资源
                ->setCreator( "rummyAdmin")             //设置文件的创建者
                ->setLastModifiedBy( "rummyAdmin");       //设置最后修改者
//                ->setTitle( "Office2007 XLSX Test Document" )    //设置标题
//                ->setSubject( "Office2007 XLSX Test Document" )  //设置主题
//                ->setDescription( "Test document for Office2007 XLSX, generated using PHP classes.") //设置备注
//                ->setKeywords( "office 2007 openxmlphp");        //设置标记
//                ->setCategory( "Test resultfile");                //设置类别
            $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $objPHPExcel->getActiveSheet()->mergeCells('B1:I1');
//            $objPHPExcel->getActiveSheet()->setCellValue('B1','用户游戏记录');
//            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
//            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
//                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日 H时:i分:s秒"));
            $objPHPExcel->setActiveSheetIndex(0)//表头的信息
                ->setCellValue('A1', "UserID")
                ->setCellValue('B1', "NickName")
                ->setCellValue('C1', "Total Rechage")
                ->setCellValue('D1', "Total Scores")
                ->setCellValue('E1', "BindScore")
                ->setCellValue('F1', "BonusScore")
                ->setCellValue('G1', "LuckScore")
                ->setCellValue('H1', "ExpScore")
                ->setCellValue('I1', "SpreadID")
                ->setCellValue('J1', "Status")
                ->setCellValue('K1', "LoginDate");
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $i=2;
            foreach ($data as $key => $value) {
                $objPHPExcel->getActiveSheet()             //     设置第一个内置表（一个xls文件里可以有多个表）为活动的
                ->setCellValue( 'A'.$i, $value['UserID'] )       //给表的单元格设置数据
                ->setCellValue( 'B'.$i, $value['NickName'] )      //数据格式可以为字符串
                ->setCellValue( 'C'.$i, '0' )      //数据格式可以为字符串
                ->setCellValue( 'D'.$i, $value['Score']/100)            //数字型
                ->setCellValue( 'E'.$i, $value['BindScore']/100 )            //
                ->setCellValue( 'F'.$i, $value['BonusScore']/100 )
                ->setCellValue( 'G'.$i, $value['LuckScore']/100 )
                ->setCellValue( 'H'.$i, $value['ExpScore']/100 )
                ->setCellValue( 'I'.$i, $value['SpreadID'] )
                ->setCellValue( 'J'.$i, $value['Status'] )
                ->setCellValue( 'K'.$i, $value['LoginDate'] );
                $i++;
            }
            //公式
            //得到当前活动的表,注意下文教程中会经常用到$objActSheet
            $objActSheet =$objPHPExcel->getActiveSheet();
            // 位置bbb *为下文代码位置提供锚
            //给当前活动的表设置名称
            $objActSheet->setTitle('AccountInfos');
            //代码还没有结束，可以复制下面的代码来决定我们将要做什么

            //我们将要做的是
            //1,直接生成一个文件
//            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//            $objWriter->save('myexchel.xlsx');
            header('Content-Type:application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="'.'AccountInfos'.date("Ymd").'.xlsx"');
//            header('Cache-Control:max-age=0');

            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }catch (\Exception $e){
		echo "error";
            //var_dump($e->getMessage());die;
        }
    }
}
