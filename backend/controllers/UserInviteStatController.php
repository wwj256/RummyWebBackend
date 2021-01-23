<?php

namespace backend\controllers;

use Yii;
use backend\models\UserInviteStat;
use backend\models\UserInviteStatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserInviteStatController implements the CRUD actions for UserInviteStat model.
 */
class UserInviteStatController extends Controller
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
     * Lists all UserInviteStat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserInviteStatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserInviteStat model.
     * @param integer $UID
     * @param string $DayStat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($UID, $DayStat)
    {
        return $this->render('view', [
            'model' => $this->findModel($UID, $DayStat),
        ]);
    }

    /**
     * Creates a new UserInviteStat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserInviteStat();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UID' => $model->UID, 'DayStat' => $model->DayStat]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserInviteStat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $UID
     * @param string $DayStat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($UID, $DayStat)
    {
        $model = $this->findModel($UID, $DayStat);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UID' => $model->UID, 'DayStat' => $model->DayStat]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserInviteStat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $UID
     * @param string $DayStat
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($UID, $DayStat)
    {
        $this->findModel($UID, $DayStat)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserInviteStat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $UID
     * @param string $DayStat
     * @return UserInviteStat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($UID, $DayStat)
    {
        if (($model = UserInviteStat::findOne(['UID' => $UID, 'DayStat' => $DayStat])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
