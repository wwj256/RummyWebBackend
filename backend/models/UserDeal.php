<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user_deal".
 *
 * 
 * @property int $UserID 用户编号
 * @property string $Password 登录密码
 * @property string $Phone 手机号
 * @property int $Score 当前金币
 * @property string $LoginIP 登录IP
 * @property string $LoginDate 登录时间
 * @property string $CreateDate 创建账号时间
 */
class UserDeal extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_deal';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Phone'], 'required'],
            [['UserID', 'Score'], 'integer'],
            [['CreateDate'], 'safe'],
            [['Password'], 'string', 'max' => 64],
            [['Phone'], 'string', 'max' => 20],
            [['Phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
    'UserID' => '用户编号',
    'Password' => '登录密码',
    'Phone' => '手机号',
    'Score' => '当前金币',
    'LoginIP' => '登录IP',
    'LoginDate' => '登录时间',
    'CreateDate' => '创建账号时间',
        ];
    }

        /**
     * 验证密码的准确性
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($password) === $this->Password;
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
        return '';
//        return $this->auth_key;
    }

    /**
     * @inheritdoc
     * 验证auth_key
     */
    public function validateAuthKey($authKey)
    {
        return true;
//        return $this->getAuthKey() === $authKey;
    }

    public function getScore()
    {
        return $this->Score;
    }
    
    /**
     * @inheritdoc
     * 根据user_backend表的主键（id）获取用户
     */
    public static function findIdentity($id)
    {
        return static::findOne(['UserID' => $id]);
    }
    public static function findByName($uName)
    {
        return static::find()->where(['Phone' => $uName])->one();
    }
}
