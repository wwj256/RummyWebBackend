<?php
namespace merchantBackend\controllers;

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
                        'actions' => ['login', 'error'],
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
        return $this->redirect('/deal-statistics/index');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        return "ee3";
        return $this->redirect('/deal-statistics/index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//        return "ee";
        $model = new LoginFormMerchant();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
}
