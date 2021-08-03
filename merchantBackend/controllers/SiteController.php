<?php
namespace merchantBackend\controllers;

use common\components\HttpTool;
use merchantBackend\models\LoginFormMerchant;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','sendsms'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionError()
    {
//        return "ee3";
        return $this->redirect('/deal/index');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        return "ee3";
        return $this->redirect('/deal/index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginFormMerchant();
        // if ($model->load(Yii::$app->request->post())) {
        //     if( $model->login() ){

        //     }
        //     return json_encode($model);
        //     return $this->goHome();
        // } 
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //登录成功后，删除短验证码
            HttpTool::deleteSMS($model->username);
            return $this->goHome();
        } 
        // echo json_encode($model);
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->on(yii\web\User::EVENT_AFTER_LOGOUT, [$this, 'onAfterLogout']);
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function onAfterLogout ($event)
    {
//        var_dump($event);die;
        $route = Url::to();
        //管理员名称
        $userName =  $event->identity->Phone;
        $userId = $event->identity->getId();
        $ip = ip2long(Yii::$app->request->userIP);
        $data = [
            'route' => $route,
            'description' => $userName.'logout',
            'user_id' => $userId,
            'ip' => $ip,
            'created_at'=>time(),
            'user_name'=>$userName,
        ];
        $model = new \common\models\AdminLog();
        $model->setAttributes($data);
        $model->save();
    }

    public function actionSendsms($phone)
    {
        // $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/sendsms?ph=%2B91{$phone}");
        // $serverRespon = json_decode($serverResponStr);
        // if( $serverRespon->code != 0 ){//服务器加币如果不成功，打印错误内容
        //     return "Send SMS error code=$serverRespon->code, ".Yii::$app->params['errorCode'][$serverRespon->code];
        // }
        // return "1";
        return HttpTool::sendSMS($phone);
    }
}
