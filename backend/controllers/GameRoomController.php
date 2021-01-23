<?php

namespace backend\controllers;

use common\components\HttpTool;
use Yii;
use backend\models\GameRoom;
use backend\models\GameRoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\data\Pagination;
/**
 * GameRoomController implements the CRUD actions for GameRoom model.
 */
class GameRoomController extends Controller
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
     * Lists all GameRoom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('GameRoomSearch');
//        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
//        $NickName = isset($form['NickName'])?trim($form['NickName']):'';
//        $OperatorID = isset($form['OperatorID'])?trim($form['OperatorID']):'';
//        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
//        $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        $query = GameRoom::find()
            ->select('game_room.*, room_control.*')
            ->joinWith("room_control");
//        $query->andFilterWhere([
//            'user_withdraw_info.UserID' => $UserID,
//            'OperatorID' => $OperatorID,
//        ]);
//
//        $query->andFilterWhere(['!=', 'user_withdraw_info.Status', 0])
//            ->andFilterWhere(['>=', 'CreateTime', $create_time])
//            ->andFilterWhere(['<=', 'CreateTime', $end_time])
//            ->andFilterWhere(['=', 'account_info.NickName', $NickName])
//            ->orderBy('CreateTime DESC');

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new GameRoomSearch();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single GameRoom model.
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
     * Creates a new GameRoom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
$model = new GameRoom();
if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['index']);
} else {
return $this->renderAjax('create', [
'model' => $model,
]);
}
}
/**
* 异步校验表单模型,Asynchronously validate the form model
*/
public function actionValidateForm()
{
$model = new GameRoom();
$model->load(Yii::$app->request->post());
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return \yii\widgets\ActiveForm::validate($model);
}
    /**
     * Updates an existing GameRoom model.
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
     * Deletes an existing GameRoom model.
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
     * Finds the GameRoom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameRoom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameRoom::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $id       userID
     * @param $value     0关闭，1开启
     * @return string
     */
    public function actionUpdateState($id, $value)
    {
        $model = $this->findModel($id);
        if( $model->RoomStatus  == $value ){
//            return '不用修改';
        }
        $model->RoomStatus = $value;
        if( $model->save() ){

        }else{
            return 'change fail';
        }

        $url = Yii::$app->params['ServerURL']."oomstate?roomid={$id}&state={$value}";
        //向服务器发送消息，通知变更
        $serverResponStr = HttpTool::doGet($url);
        $serverRespon = json_decode($serverResponStr);
        if( $serverRespon ){
            if( $serverRespon->CODE != 0 ){//服务器加币如果不成功，打印错误内容
                return 'Update State fail, errorCode='.$serverRespon->CODE;
            }
        }else{
            return 'Update State fail, ERR_CONNECTION_REFUSED';
        }
        return 'Update State sucess!';
    }
}
