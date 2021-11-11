<?php

namespace backend\controllers;

use common\components\HttpTool;
use Yii;
use backend\models\UserWithdrawInfo;
use backend\models\UserWithdrawInfoSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * UserWithdrawInfoController implements the CRUD actions for UserWithdrawInfo model.
 */
class UserWithdrawInfoController extends Controller
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
     * Lists all UserWithdrawInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserWithdrawInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserWithdrawInfo model.
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

    public function actionRecord()
    {
        $form = Yii::$app->request->get('UserWithdrawInfoSearch');
        $ID = isset($form['ID'])?trim($form['ID']):'';
        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        $NickName = isset($form['NickName'])?trim($form['NickName']):'';
        $OperatorID = isset($form['OperatorID'])?trim($form['OperatorID']):'';
        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        $query = UserWithdrawInfo::find()
            ->select('user_withdraw_info.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere([
            'user_withdraw_info.ID' => $ID,
            'user_withdraw_info.UserID' => $UserID,
            'OperatorID' => $OperatorID,
        ]);

        $query->andFilterWhere(['!=', 'user_withdraw_info.Status', 0])
            ->andFilterWhere(['>=', 'CreateTime', $create_time])
            ->andFilterWhere(['<=', 'CreateTime', $end_time])
            ->andFilterWhere(['=', 'account_info.NickName', $NickName])
            ->orderBy('CreateTime DESC');

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '20']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new UserWithdrawInfoSearch();
        $searchModel->load(Yii::$app->request->queryParams);


        return $this->render('record', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Creates a new UserWithdrawInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
$model = new UserWithdrawInfo();
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
$model = new UserWithdrawInfo();
$model->load(Yii::$app->request->post());
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return \yii\widgets\ActiveForm::validate($model);
}
    /**
     * Updates an existing UserWithdrawInfo model.
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
     * Deletes an existing UserWithdrawInfo model.
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
     * 修改银行的申请状态
     * @param $id   ID
     * @param $value    状态 1:同意，2:拒绝
     * @param null $desc    描述
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionChangeStates($id, $value, $desc=null)
    {
        $model = $this->findModel($id);
        if( $model->Status  == $value ){
//            return '不用修改';
        }
        $model->Status = $value;
        $model->OperatorID = Yii::$app->user->id;
        $model->OperatorTime = date("Y-m-d H:i:s");
        if( $desc ) $model->Desc = $desc;

        $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/draw?oid={$id}&operid={$model->OperatorID}&mode=0&stat={$value}");
        $serverRespon = json_decode($serverResponStr);
        // return $serverResponStr;
        if( $serverRespon ){
            if( $serverRespon->code != 0 ){//服务器加币如果不成功，打印错误内容
                return 'action failure, errorCode='.$serverRespon->code;
            }
            return 'action success!';
        }else{
            return 'action failure, ERR_CONNECTION_REFUSED';
        }
    }

    /**
     * Finds the UserWithdrawInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserWithdrawInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserWithdrawInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
