<?php

namespace backend\controllers;

use Yii;
use backend\models\GameRecord;
use backend\models\GameRecordSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameRecordController implements the CRUD actions for GameRecord model.
 */
class GameRecordController extends Controller
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
     * Lists all GameRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('GameRecordSearch');
        $RcdId = isset($form['RcdId'])?trim($form['RcdId']):'';
        $Turns = isset($form['Turns'])?trim($form['Turns']):'';
        $GameId = isset($form['GameId'])?trim($form['GameId']):'';
        $query = GameRecord::find()
            ->select('game_record.*, game_type.GameName')
            ->joinWith("game_type");
        $query->andFilterWhere([
            'game_record.RcdId' => $RcdId,
            'game_record.GameId' => $GameId,
            'game_record.Turns' => $Turns
        ]);
        $query->orderBy('BeginTime DESC');
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new GameRecordSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single GameRecord model.
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($RcdId, $Turns)
    {
        return $this->render('view', [
            'model' => $this->findModel($RcdId, $Turns),
        ]);
    }

    /**
     * Creates a new GameRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GameRecord();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GameRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($RcdId, $Turns)
    {
        $model = $this->findModel($RcdId, $Turns);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RcdId' => $model->RcdId, 'Turns' => $model->Turns]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GameRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $RcdId
     * @param integer $Turns
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($RcdId, $Turns)
    {
        $this->findModel($RcdId, $Turns)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GameRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $RcdId
     * @param integer $Turns
     * @return GameRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($RcdId, $Turns)
    {
        if (($model = GameRecord::findOne(['RcdId' => $RcdId, 'Turns' => $Turns])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
