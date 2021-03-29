<?php

namespace backend\controllers;

use Yii;
use backend\models\SpreadConfig;
use backend\models\SpreadConfigSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * SpreadConfigController implements the CRUD actions for SpreadConfig model.
 */
class SpreadConfigController extends Controller
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
     * Lists all SpreadConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = Yii::$app->request->get('SpreadConfigSearch');
        $query = SpreadConfig::find()
            ->select('*');
        $pages = new Pagination(['totalCount' =>$query->count(), 'pageSize' => '50']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $searchModel = new SpreadConfigSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single SpreadConfig model.
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
     * Creates a new SpreadConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
$model = new SpreadConfig();
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
$model = new SpreadConfig();
$model->load(Yii::$app->request->post());
Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
return \yii\widgets\ActiveForm::validate($model);
}
    /**
     * Updates an existing SpreadConfig model.
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
     * Deletes an existing SpreadConfig model.
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
     * Finds the SpreadConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SpreadConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpreadConfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
