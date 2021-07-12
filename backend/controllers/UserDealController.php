<?php

namespace backend\controllers;

use Yii;
use backend\models\UserDeal;
use backend\models\UserDealSearch;
use common\models\LogAdminTrade;
use mdm\admin\models\Assignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserDealController implements the CRUD actions for UserDeal model.
 */
class UserDealController extends Controller
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
     * Lists all UserDeal models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        
        // $statisticsSql = "INSERT INTO lami_deal.user_deal (Phone,Password,Score) VALUES ('12222','$pwd',1000);";
        // $statisticsData = Yii::$app->db->createCommand($statisticsSql)
        //     ->execute();
        // echo $statisticsData;
        $searchModel = new UserDealSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $uid = Yii::$app->user->identity->getId();
        $statisticsSql = "SELECT * FROM lami_backend.auth_assignment WHERE item_name = '管理员' AND user_id = $uid";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->queryAll();
        $isAdmin = count($statisticsData) > 0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Displays a single UserDeal model.
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
     * Creates a new UserDeal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserDeal();
        //加载默认值
        if ($model->load(Yii::$app->request->post()) ) {
            $pwd = $model->Password;
            $model->Password = md5($model->Password);
            $adminID = Yii::$app->user->id;
            $model->Score = $model->Score ? $model->Score * 100 : 0;
            $result = $model->save();
            if($result){
                if( $model->Score > 0 ){
                    $logModel = new LogAdminTrade();
                    $logModel->UserID = $model->UserID;
                    $logModel->Score = 0;
                    $logModel->SChange = $model->Score;
                    $logModel->AdminID = $adminID;
                    $logModel->save();
                }
                $assignmentItem = '币商权限';
                $modelAssignment = new Assignment($model->UserID);
                $success = $modelAssignment->assign([$assignmentItem]);
                return $this->redirect(['view', 'id' => $model->UserID]);
            }
            $model->Password = $pwd;
            $model->Score = $model->Score / 100;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserDeal model.
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
     * Deletes an existing UserDeal model.
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
     * Finds the UserDeal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDeal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDeal::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddScore($id, $SChange=0)
    {
        $tradeModel = $this->findModel($id);

        $SChange = (int)$SChange*100;


        //管理员名称
        $adminID = Yii::$app->user->id;
        $model = new LogAdminTrade();
        $model->UserID = $id;
        $model->Score = $tradeModel->Score;
        $model->SChange = $SChange;
        $model->AdminID = $adminID;

        //金币变化日志模型
        // $scoreChangeModel = Yii::$app->runAction('user-score-change/get-add-model',['UID'=>$id,'SType'=>"4", 'SChange'=>$SChange,'BindChg'=>$BindChg,'BonusChg'=>$BonusChg,'LuckChg'=>$LuckChg,'Reason'=>$desc, 'RelateID'=>$adminID]);
        // $url = Yii::$app->params['ServerURL']."addscore?userid={$id}&score={$score}&stype=4";
        
        //服务器加币成功后，金币变化日志模型保存日志数据,服务器会自已添加日志，后台不用再添加日志
        // if( !$scoreChangeModel->save() ){
        //     return "filed";
        // };
        $statisticsSql = "UPDATE lami_deal.user_deal SET Score=Score+$SChange WHERE UserID = $id;";
        $statisticsData = Yii::$app->db->createCommand($statisticsSql)
            ->execute();
        if( $statisticsData && $model->save()){
            return 1;
        }else{
            return 'add error!';
        }
    }

    public function actionChangepwd($id, $pwd)
    {
        $model = $this->findModel($id);
        $model->Password = md5($pwd);
        return $model->save();
    }
}
