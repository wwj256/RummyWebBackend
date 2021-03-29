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
        $query = GameRecordPlayer::find()
            ->select('game_record_player.*, account_info.NickName')
            ->joinWith("account_info");
        $query->andFilterWhere([
            'game_record_player.RcdId' => $RcdId,
            'game_record_player.UID' => $UID,
            'game_record_player.Turns' => $Turns
        ]);
        $query->orderBy('BeginTime DESC');
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
}
