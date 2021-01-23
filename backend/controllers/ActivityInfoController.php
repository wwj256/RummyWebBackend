<?php

namespace backend\controllers;

use common\components\HttpTool;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yii;
use backend\models\ActivityInfo;
use backend\models\ActivityInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * ActivityInfoController implements the CRUD actions for ActivityInfo model.
 */
class ActivityInfoController extends Controller
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
     * Lists all ActivityInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivityInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploadImage($url)
    {
        echo "start".$url;
        $file = $url; //$file：图片地址
        if($fp = fopen($file,"rb", 0))
        {
            $gambar = fread($fp,filesize($file));
            fclose($fp);

            //获取图片base64
            $base64 = chunk_split(base64_encode($gambar));
//            Yii::debug($base64);
            echo $base64;
            $data = new class{};
            $data->PreKey = "Lami*2020#zz";
            $data->Type = 3;
            $data->Name = "TEst3";
            $data->Data = $base64;
            $dataStr = json_encode($data);
//            Yii::debug($dataStr);
            echo HttpTool::http_postRaw(Yii::$app->params['APIUrl'].'image/UploadImg',$dataStr);
//            Yii::debug(HttpTool::http_postRaw('https://192.168.3.236:18080/image/UploadImg',$dataStr));
//            HttpTool::doPost('https://192.168.3.236:18080/image/UploadImg',$base64);
        }
    }

    /**
     * Displays a single ActivityInfo model.
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
     * Creates a new ActivityInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivityInfo();
        //加载默认值
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $model->StartTime = date("Y-m-d");
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
    * 异步校验表单模型,Asynchronously validate the form model
    */
    public function actionValidateForm()
    {
    $model = new ActivityInfo();
    $model->load(Yii::$app->request->post());
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return \yii\widgets\ActiveForm::validate($model);
    }
    /**
     * Updates an existing ActivityInfo model.
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
     * Deletes an existing ActivityInfo model.
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
     * Finds the ActivityInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
