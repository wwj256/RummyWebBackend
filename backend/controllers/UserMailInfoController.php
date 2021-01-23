<?php

namespace backend\controllers;

use backend\models\SysConfig;
use common\components\HttpTool;
use Yii;
use backend\models\UserMailInfo;
use backend\models\UserMailInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserMailInfoController implements the CRUD actions for UserMailInfo model.
 */
class UserMailInfoController extends Controller
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
     * Lists all UserMailInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserMailInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserMailInfo model.
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
     * Creates a new UserMailInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserMailInfo();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $url = Yii::$app->params['ServerURL']."notifymail?userid={$model->UserID}";
            //向服务器发送消息，通知变更
            $serverResponStr = HttpTool::doGet($url);
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserMailInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $url = Yii::$app->params['ServerURL']."notifymail?userid={$model->UserID}";
            //向服务器发送消息，通知变更
            $serverResponStr = HttpTool::doGet($url);
            return $this->redirect(['view', 'id' => $model->ID]);
        }
        $mailExpireTime = SysConfig::findOne('mailExpireTime');
        $model->loadDefaultValues();
        $model->SendTime = \date("Y-m-d H:m:s");
        $model->ExpireTime = \date("Y-m-d H:m:s",strtotime($model->SendTime) + 60*60*24*$mailExpireTime->V);;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserMailInfo model.
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
     * Finds the UserMailInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserMailInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserMailInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddMail($UserID, $Title, $Content)
    {
        $mailExpireTime = SysConfig::findOne('mailExpireTime');
        $model = new UserMailInfo();
        $model->SysID = 0;
        $model->UserID = $UserID;
        $model->Title = $Title;
        $model->Content = $Content;
        $model->SendTime = \date("Y-m-d H:m:s");
        $model->ExpireTime = \date("Y-m-d H:m:s",strtotime($model->SendTime) + 60*60*24*$mailExpireTime->V);
        if( $model->save() ){
            $url = Yii::$app->params['ServerURL']."notifymail?userid={$UserID}";
            //向服务器发送消息，通知变更
            $serverResponStr = HttpTool::doGet($url);
            return "1";
        }
        return '0';
    }
}
