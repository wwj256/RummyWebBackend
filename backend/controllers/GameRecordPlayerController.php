<?php

namespace backend\controllers;

use Yii;
use backend\models\GameRecordPlayer;
use backend\models\GameRecordPlayerSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameRecordPlayerController implements the CRUD actions for GameRecordPlayer model.
 */
class GameRecordPlayerController extends Controller
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
     * Lists all GameRecordPlayer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('GameRecordPlayerSearch');
        $RcdId = isset($form['RcdId'])?trim($form['RcdId']):'';
        $Turns = isset($form['Turns'])?trim($form['Turns']):'';
        $UID = isset($form['UID'])?trim($form['UID']):'';
        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';

        $query = GameRecordPlayer::find()
            ->select('game_record_player.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere(['>=', 'BeginTime', $create_time])
            ->andFilterWhere(['<=', 'BeginTime', $end_time]);
        $query->andFilterWhere([
            'game_record_player.RcdId' => $RcdId,
            'game_record_player.UID' => $UID,
            'game_record_player.Turns' => $Turns
        ]);
        $query->orderBy('BeginTime DESC');

        $action = Yii::$app->request->get('action');
        if ($action == 'export') {
            $model = $query->asArray()->all();    
            $this->actionExport($model);
            return;
        }

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new GameRecordPlayerSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single GameRecordPlayer model.
     * @param integer $UID
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($UID, $RcdId, $Turns)
    {
        return $this->render('view', [
            'model' => $this->findModel($UID, $RcdId, $Turns),
        ]);
    }

    /**
     * Creates a new GameRecordPlayer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GameRecordPlayer();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UID' => $model->UID, 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GameRecordPlayer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $UID
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($UID, $RcdId, $Turns)
    {
        $model = $this->findModel($UID, $RcdId, $Turns);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UID' => $model->UID, 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GameRecordPlayer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $UID
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($UID, $RcdId, $Turns)
    {
        $this->findModel($UID, $RcdId, $Turns)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GameRecordPlayer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $UID
     * @param integer $RcdId
     * @param integer $Turns
     * @return GameRecordPlayer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($UID, $RcdId, $Turns)
    {
        if (($model = GameRecordPlayer::findOne(['UID' => $UID, 'RcdId' => $RcdId, 'Turns' => $Turns])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionExport($data=null)
    {
        if (!$data) {
            return;
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
                ->setCellValue('A1', "RcdId")
                ->setCellValue('B1', "Turns")
                ->setCellValue('C1', "UID")
                ->setCellValue('D1', "NickName")
                ->setCellValue('E1', "IsNewUser")
                ->setCellValue('F1', "SpreadID")
                ->setCellValue('G1', "BeginScore")
                ->setCellValue('H1', "WinScore")
                ->setCellValue('I1', "Bind")
                ->setCellValue('J1', "BindChg")
                ->setCellValue('K1', "Bonus")
                ->setCellValue('L1', "BonusChg")
                ->setCellValue('M1', "PlyTax")
                ->setCellValue('N1', "BrokeUp")
                ->setCellValue('O1', "BeginTime");
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $i=2;
            foreach ($data as $key => $value) {
                $objPHPExcel->getActiveSheet()             //     设置第一个内置表（一个xls文件里可以有多个表）为活动的
                ->setCellValue( 'A'.$i, $value['RcdId'] )       //给表的单元格设置数据
                ->setCellValue( 'B'.$i, $value['Turns'] )       //给表的单元格设置数据
                ->setCellValue( 'C'.$i, $value['UID'] )      //数据格式可以为字符串
                ->setCellValue( 'D'.$i, $value['NickName'])            //数字型
                ->setCellValue( 'E'.$i, $value['NewUser'] == 1 ? 'New' : 'Old')            //数字型
                ->setCellValue( 'F'.$i, $value['SpreadID'] )            //
                ->setCellValue( 'G'.$i, $value['BeginScore']/100 )
                ->setCellValue( 'H'.$i, $value['WinScore']/100)
                ->setCellValue( 'I'.$i, $value['Bind']/100)
                ->setCellValue( 'J'.$i, $value['BindChg']/100)
                ->setCellValue( 'K'.$i, $value['Bonus']/100)
                ->setCellValue( 'L'.$i, $value['BonusChg']/100)
                ->setCellValue( 'M'.$i, $value['PlyTax']/100)
                ->setCellValue( 'N'.$i, $value['BrokeUp'])
                ->setCellValue( 'O'.$i, $value['BeginTime']);
                $i++;
            }
            //公式
            //得到当前活动的表,注意下文教程中会经常用到$objActSheet
            $objActSheet =$objPHPExcel->getActiveSheet();
            // 位置bbb *为下文代码位置提供锚
            //给当前活动的表设置名称
            $objActSheet->setTitle('GameRecordPlayer');
            //代码还没有结束，可以复制下面的代码来决定我们将要做什么

            //我们将要做的是
            //1,直接生成一个文件
//            $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//            $objWriter->save('myexchel.xlsx');
            header('Content-Type:application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="'.'GameRecordPlayer'.'_'.date("Ymd").'.xlsx"');
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
