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
        $query = UserScoreChange::find()
            ->select('user_score_change.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere([
            'user_score_change.UID' => $UserID
        ]);
        $query->orderBy('UpdateTime DESC');
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


}
