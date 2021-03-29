<?php

namespace backend\controllers;

use Yii;
use backend\models\ScoreInfo;
use backend\models\ScoreInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * ScoreInfoController implements the CRUD actions for ScoreInfo model.
 */
class ScoreInfoController extends Controller
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
     * Lists all ScoreInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScoreInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScoreInfo model.
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
     * Creates a new ScoreInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
$model = new ScoreInfo();
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
$model = new ScoreInfo();
$model->load(Yii::$app->request->post());
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return \yii\widgets\ActiveForm::validate($model);
}
    /**
     * Updates an existing ScoreInfo model.
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
            return $this->renderAjax('update', [
            'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ScoreInfo model.
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
     * Finds the ScoreInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScoreInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScoreInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
