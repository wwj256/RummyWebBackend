<?php

namespace backend\controllers;

use backend\models\AccountInfo;
use backend\models\ScoreInfo;
use Yii;
use backend\models\UserScoreChange;
use backend\models\UserScoreChangeSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserScoreChangeController implements the CRUD actions for UserScoreChange model.
 */
class UserScoreChangeController extends Controller
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
     * Lists all UserScoreChange models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('UserScoreChangeSearch');
        $UserID = isset($form['UID'])?trim($form['UID']):'';

        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';

        $query = UserScoreChange::find()
            ->select('user_score_change.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere(['>=', 'UpdateTime', $create_time])
            ->andFilterWhere(['<=', 'UpdateTime', $end_time]);
        $query->andFilterWhere([
            'user_score_change.UID' => $UserID
        ]);
        $query->orderBy('UpdateTime DESC');

        $action = Yii::$app->request->get('action');
        if ($action == 'export') {
            $model = $query->asArray()->all();    
            $this->actionExport($model);
            return;
        }

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new UserScoreChangeSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single UserScoreChange model.
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
     * Creates a new UserScoreChange model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserScoreChange();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserScoreChange model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserScoreChange model.
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
     * Finds the UserScoreChange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserScoreChange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserScoreChange::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * @param $UID          用户标识
     * @param $SType        1游戏,2支付,3提现,4管理员,5:返拥
     * @param int $SChange  总金币变化量
     * @param int $BindChg  绑定金币变化
     * @param int $BonusChg 赠送金币变化
     * @param int $LuckChg  幸运金币变更
     * @param int $RelateID 关联ID，SType=2兑换券ID，SType=1游戏记录ID，SType=4管理员ID，，SType=5被邀请人ID,，SType=6被邀请人充值ID
     * @param string $Reason    原因
     * @return bool         返回值：1表示保存成功，否则表示失败
     */
    public function actionGetAddModel($UID, $SType, $SChange=0, $BindChg=0, $BonusChg=0, $LuckChg=0, $RelateID=0, $Reason='')
    {

        $accountModel = AccountInfo::findOne($UID);
        $scoreModel = ScoreInfo::findOne($UID);
        $model = new UserScoreChange();
        //加载默认值
//        $model->loadDefaultValues();
        $model->UID = $UID;
        $model->NewUser = $accountModel->isNewUser();
        $model->SpreadID = $accountModel->SpreadID;;
        $model->SType = $SType;
        $model->Score = $scoreModel->Score;
        $model->SChange = $SChange+$BindChg;
        $model->Bind = $scoreModel->BindScore;
        $model->BindChg = $BindChg;
        $model->Bonus = $scoreModel->BonusScore;
        $model->BonusChg = $BonusChg;
        $model->Luck = $scoreModel->LuckScore;
        $model->LuckChg = $LuckChg;
        $model->RelateID = $RelateID;
        $model->Reason = $Reason;
        return $model;
//        return $model->save();
    }

    public function actionExport($data=null)
    {
        if (!$data) {
            return;
            // $query = GameRecord::find()
            // ->select('user_coupon_info.*, account_info.NickName')
            // ->joinWith("account_info");
        
            // $query->orderBy('ID DESC');
            // $data = $query->offset(0)->limit(1)->asArray()->all();

            // echo json_encode($data);
            // return;
            // $data = $query->asArray()->all();  
        }
        
        try{
            //实例化
            $objPHPExcel = new \PHPExcel();
            //设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
            $objPHPExcel
                ->getProperties()  //获得文件属性对象，给下文提供设置资源
                ->setCreator( "rummyAdmin")             //设置文件的创建者
                ->setLastModifiedBy( "rummyAdmin");       //设置最后修改者
            $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $objPHPExcel->getActiveSheet()->mergeCells('B1:I1');
//            $objPHPExcel->getActiveSheet()->setCellValue('B1','用户游戏记录');
//            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
//            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
//                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日 H时:i分:s秒"));
            $objPHPExcel->setActiveSheetIndex(0)//表头的信息
                ->setCellValue('A1', "ID")
                ->setCellValue('B1', "UID")
                ->setCellValue('C1', "NickName")
                ->setCellValue('D1', "Type")
                ->setCellValue('E1', "Score")
                ->setCellValue('F1', "SChange")
                ->setCellValue('G1', "Bind")
                ->setCellValue('H1', "BindChg")
                ->setCellValue('I1', "Bonus")
                ->setCellValue('J1', "BonusChg")
                ->setCellValue('K1', "Luck")
                ->setCellValue('L1', "LuckChg")
                ->setCellValue('M1', "RelateID")
                ->setCellValue('N1', "UpdateTime");

            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $i=2;
            foreach ($data as $key => $value) {
                $objPHPExcel->getActiveSheet()             //     设置第一个内置表（一个xls文件里可以有多个表）为活动的
                ->setCellValue( 'A'.$i, $value['ID'] )       //给表的单元格设置数据
                ->setCellValue( 'B'.$i, $value['UID'] )       //给表的单元格设置数据
                ->setCellValue( 'C'.$i, $value['NickName'] )      //数据格式可以为字符串
                ->setCellValue( 'D'.$i, Yii::$app->params['scoreChangeTypes'][$value['SType']])            //数字型
                ->setCellValue( 'E'.$i, $value['Score']/100)            //数字型
                ->setCellValue( 'F'.$i, $value['SChange']/100 )            //
                ->setCellValue( 'G'.$i, $value['Bind']/100 )
                ->setCellValue( 'H'.$i, $value['BindChg']/100 )
                ->setCellValue( 'I'.$i, $value['Bonus']/100 )
                ->setCellValue( 'J'.$i, $value['BonusChg']/100 )
                ->setCellValue( 'K'.$i, $value['Luck']/100 )
                ->setCellValue( 'L'.$i, $value['LuckChg']/100 )
                ->setCellValue( 'M'.$i, "'".$value['RelateID'] )
                ->setCellValue( 'N'.$i, $value['UpdateTime'] );
                $i++;
            }
            //公式
            //得到当前活动的表,注意下文教程中会经常用到$objActSheet
            $objActSheet =$objPHPExcel->getActiveSheet();
            // 位置bbb *为下文代码位置提供锚
            //给当前活动的表设置名称
            $objActSheet->setTitle('UserScoreChangeList');
            //代码还没有结束，可以复制下面的代码来决定我们将要做什么

            //我们将要做的是
            //1,直接生成一个文件
//            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//            $objWriter->save('myexchel.xlsx');
            header('Content-Type:application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="'.'UserScoreChangeList'.'_'.date("Ymd").'.xlsx"');
//            header('Cache-Control:max-age=0');

            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }catch (\Exception $e){
		    echo "error:".$e->getMessage();
            //var_dump($e->getMessage());die;
        }
    }
}
