<?php

namespace merchantBackend\models;

use common\models\Proxyconfig;
use common\models\Statdayproxy;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user_backend".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property int $is_admin 1:系统
 * @property string $created_at
 * @property string $updated_at
 */
class UserBackend extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $code;
//    public $username;
//    public $email;
    public $password;
//    public $created_at;
//    public $updated_at;
//    public $is_admin;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_backend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // 对username的值进行两边去空格过滤
            ['username', 'filter', 'filter' => 'trim'],
            // required表示必须的，也就是说表单提交过来的值必须要有, message 是username不满足required规则时给的提示消息
            ['username', 'required', 'message' => '用户名不可以为空'],
            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['username', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在.'],
            // string 字符串，这里我们限定的意思就是username至少包含2个字符，最多255个字符
            ['username', 'string', 'min' => 2, 'max' => 255],
            // 下面的规则基本上都同上，不解释了
            ['email', 'filter', 'filter' => 'trim'],
            //['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已经被设置了.'],
            ['password', 'required', 'message' => '密码不可以为空'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],
            // default 默认在没有数据的时候才会进行赋值
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '账号',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码',
            'is_admin' => 'Is Admin',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @inheritdoc
     * 根据user_backend表的主键（id）获取用户
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     * 根据access_token获取用户，我们暂时先不实现，我们在文章 http://www.manks.top/yii2-restful-api.html 有过实现，如果你感兴趣的话可以先看看
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     * 用以标识 Yii::$app->user->id 的返回值
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * 获取auth_key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     * 验证auth_key
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * 为model的password_hash字段生成密码的hash值
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    /**
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * 根据user_backend表的username获取用户
     *
     * @param string $username
     * @return \backend\models\UserBackend|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
    }
    /**
     * 验证密码的准确性
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public function getProxyconfig()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(Proxyconfig::className(), ['id' => 'cid']);
    }
    /*
     * 关联statdaypaoxy表
     * */
    public function getStatdayproxy()
    {
        return $this->hasOne(Statdayproxy::className(), ['proxyid' => 'id']);
    }

    public function signup()
    {
//        echo $this->password;die;
        // 调用validate方法对表单数据进行验证，验证规则参考上面的rules方法，如果不调用validate方法，那上面写的rules就完全是废的啦
        if (!$this->validate()) {

            return null;
        }
        // 实现数据入库操作
//        $user = new UserBackend();
//        $user->username = $this->username;
        //$user->email = $this->email;
        $this->created_at = $this->created_at;
        $this->updated_at = $this->updated_at;
        // 设置密码，密码肯定要加密，暂时我们还没有实现，继续阅读下去，我们在下面有实现
        $this->setPassword($this->password);
        // 生成 "remember me" 认证key
        $this->generateAuthKey();
        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，这是没有必要的。
        // 因为我们上面已经调用Signup的rules校验过了，这里就没必要再用UserBackend的rules校验了

        return $this->save(false);
    }
}
