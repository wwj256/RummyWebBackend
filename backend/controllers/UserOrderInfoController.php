<?php

namespace backend\controllers;

use Yii;
use backend\models\UserOrderInfo;
use backend\models\UserOrderInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * UserOrderInfoController implements the CRUD actions for UserOrderInfo model.
 */
class UserOrderInfoController extends Controller
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
     * Lists all UserOrderInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new UserOrderInfoSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // $action = Yii::$app->request->get('action');
        // if ($action == 'export') {
        //     // $model = $query->asArray()->all();    
        //     $this->actionExport($dataProvider);
        //     return;
        // }
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

        $form = Yii::$app->request->get('UserOrderInfoSearch');
        $OrderID = isset($form['OrderID'])?trim($form['OrderID']):'';
        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        $NickName = isset($form['NickName'])?trim($form['NickName']):'';
        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        $query = UserOrderInfo::find()
            ->select('user_order_info.*, account_info.NickName, account_info.LoginIP,user_bind_info.Phone,user_bind_info.Mail')
            ->joinWith("account_info")
            ->joinWith("user_bind_info");
        $query->andFilterWhere([
            'user_order_info.OrderID' => $OrderID,
            'user_order_info.UserID' => $UserID,
        ]);

        $query->
            andFilterWhere(['>=', 'CreateTime', $create_time])
            // ->andFilterWhere(['!=', 'user_order_info.Status', 0])
            ->andFilterWhere(['<=', 'CreateTime', $end_time])
            ->andFilterWhere(['=', 'account_info.NickName', $NickName])
            ->orderBy('CreateTime DESC');

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new UserOrderInfoSearch();
        $searchModel->load(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single UserOrderInfo model.
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
     * Creates a new UserOrderInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserOrderInfo();
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
     * Updates an existing UserOrderInfo model.
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
     * Deletes an existing UserOrderInfo model.
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
     * Finds the UserOrderInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserOrderInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserOrderInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionExport($data=null)
    {
        if (!$data) {
            $query = UserOrderInfo::find()
            ->select('user_order_info.*, account_info.NickName')
            ->joinWith("account_info");
        
            $query->orderBy('ID DESC');
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
                ->setCellValue('A1', "OrderID")
                ->setCellValue('B1', "UserID")
                ->setCellValue('C1', "NickName")
                ->setCellValue('D1', "Type")
                ->setCellValue('E1', "Status")
                ->setCellValue('F1', "UsedTime")
                ->setCellValue('G1', "CreateTime")
                ->setCellValue('H1', "ExpireTime");
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $i=2;
            foreach ($data as $key => $value) {
                $objPHPExcel->getActiveSheet()             //     设置第一个内置表（一个xls文件里可以有多个表）为活动的
                ->setCellValue( 'A'.$i, $value['ID'] )       //给表的单元格设置数据
                ->setCellValue( 'B'.$i, $value['UserID'] )       //给表的单元格设置数据
                ->setCellValue( 'C'.$i, $value['NickName'] )      //数据格式可以为字符串
                ->setCellValue( 'D'.$i, $value['Type'])            //数字型
                ->setCellValue( 'E'.$i, $value['Status'])            //数字型
                ->setCellValue( 'F'.$i, $value['UsedTime'] )            //
                ->setCellValue( 'G'.$i, $value['CreateTime'] )
                ->setCellValue( 'H'.$i, $value['ExpireTime']);
                $i++;
            }
            //公式
            //得到当前活动的表,注意下文教程中会经常用到$objActSheet
            $objActSheet =$objPHPExcel->getActiveSheet();
            // 位置bbb *为下文代码位置提供锚
            //给当前活动的表设置名称
            $objActSheet->setTitle('UserCouponInfos');
            //代码还没有结束，可以复制下面的代码来决定我们将要做什么

            //我们将要做的是
            //1,直接生成一个文件
//            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//            $objWriter->save('myexchel.xlsx');
            header('Content-Type:application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="'.'UserCouponInfos_'.date("Ymd").'.xlsx"');
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
