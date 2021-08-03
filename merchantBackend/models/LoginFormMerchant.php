<?php
namespace merchantBackend\models;

use Yii;
use yii\base\Model;
use backend\models\UserDeal as User;
use common\components\HttpTool;
use yii\helpers\Url;

/**
 * Login form
 */
class LoginFormMerchant extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $code;
    public $needCheckOTP = false;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['code', 'validateSMSCode']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user){
                if(!$user->validatePassword($this->password)){
                    $this->addError($attribute, 'Account password error！');
                }else{
                    // if ($user->ustate == 0 ){
                    //     $this->addError($attribute, '您的账户已冻结，请与客服联系！');
                    // }
                    // $model = Acctapi::findOne($user->uid);
                    // if( $model ){
                    //     if ($model->ustate == 0 ){
                    //         $this->addError($attribute, '您的账户已冻结，请与客服联系！');
                    //     }
                    // }else {
                    //     $this->addError($attribute, '您的账户类型不是商户，请与客服联系！');
                    // }
                }
                $this->validateSMSCode('code',null);
            }else{
                $this->addError($attribute, 'The account name does not exist！');
            }
        }
    }

    public function validateSMSCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if( $this->code ){
                $this->needCheckOTP = true;
                $serverResponStr = HttpTool::doGet(Yii::$app->params['APIUrl']."houtai/checksms?ph=%2B91$this->username&cd=$this->code");
                $serverRespon = json_decode($serverResponStr);
                if( $serverRespon->code != 0 ){
                    $this->addError($attribute, "OTP Sending Error! code=$serverRespon->code");
                }
            }else{
                $user = $this->getUser();
                $ip = Yii::$app->request->userIP;
                if( $user->LoginIP != "" && $user->LoginIP != $ip ){
                    $this->needCheckOTP = true;
                    $this->addError($attribute, "The IP address is different from the last login IP address and requires OTP authentication");    
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->user->on(yii\web\User::EVENT_AFTER_LOGIN, [$this, 'onAfterLogin']);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByName($this->username);
        }

        return $this->_user;
    }

    public function onAfterLogin ($event)
    {
        //var_dump($event);die;
        $route = Url::to();
        //管理员名称
        $userName = Yii::$app->user->identity->Phone;
        $userId = Yii::$app->user->identity->getId();
        $ip = ip2long(Yii::$app->request->userIP);
        $logIp = long2ip($ip);
        $data = [
            'route' => $route,
            'description' => $userName.'login，ip：'.Yii::$app->request->userIP,
            'user_id' => $userId,
            'ip' => $ip,
            'created_at'=>time(),
            'user_name'=>$userName,
        ];
        $model = new \common\models\AdminLog();
        $model->setAttributes($data);
        $model->save();

        $model = $this->getUser();
        $model->LoginIP = Yii::$app->request->userIP;
        $model->LoginDate = date("Y-m-d H:m:s");
        $model->save();
    }

}
