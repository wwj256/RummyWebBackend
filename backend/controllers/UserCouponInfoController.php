<?php

namespace backend\controllers;

use Yii;
use backend\models\UserCouponInfo;
use backend\models\UserCouponInfoSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserCouponInfoController implements the CRUD actions for UserCouponInfo model.
 */
class UserCouponInfoController extends Controller
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
     * Lists all UserCouponInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('UserCouponInfoSearch');
        $ID = isset($form['ID'])?trim($form['ID']):'';
        $UserID = isset($form['UserID'])?trim($form['UserID']):'';
        $Status = isset($form['Status'])?trim($form['Status']):'';
        $Type = isset($form['Type'])?trim($form['Type']):'';
        $create_time = isset($form['create_time'])?trim($form['create_time']):'';
        $end_time = isset($form['end_time'])?trim($form['end_time']):'';
        $query = UserCouponInfo::find()
            ->select('user_coupon_info.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere([
            'user_coupon_info.ID' => $ID,
            'user_coupon_info.UserID' => $UserID,
            'user_coupon_info.Status' => $Status,
            'user_coupon_info.Type' => $Type,
        ]);
        $query->andFilterWhere(['>=', 'CreateTime', $create_time])
            ->andFilterWhere(['<=', 'CreateTime', $end_time])
            ->orderBy('CreateTime DESC');

        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new UserCouponInfoSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single UserCouponInfo model.
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
     * Creates a new UserCouponInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserCouponInfo();
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
     * Updates an existing UserCouponInfo model.
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
     * Deletes an existing UserCouponInfo model.
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
     * Finds the UserCouponInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserCouponInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserCouponInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
