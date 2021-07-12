<?php

namespace merchantBackend\components;

use Yii;
use yii\helpers\Url;

class AdminLog
{
    public static function write($event)
    {
        //var_dump($event);die;
        // 排除日志表自身,没有主键的表不记录（没想到怎么记录。。每个表尽量都有主键吧，不一定非是自增id）
        if($event->sender instanceof \common\models\AdminLog || !$event->sender->primaryKey()) {
            return;
        }
        // 显示详情有待优化,不过基本功能完整齐全
        if ($event->name == yii\db\ActiveRecord::EVENT_AFTER_INSERT) {
            $description = "%s新增了表%s %s:%s的%s";
        } elseif($event->name == yii\db\ActiveRecord::EVENT_AFTER_UPDATE) {
            $description = "%s修改了表%s %s:%s的%s";
        } elseif($event->name == yii\db\ActiveRecord::EVENT_AFTER_DELETE) {
            $description = "%s删除了表%s %s:%s%s";
        }
        if (!empty($event->changedAttributes)) {

            $desc = '';
            foreach($event->changedAttributes as $name => $value) {
                $desc .= $name . ' : ' . $value . '=>' . $event->sender->getAttribute($name) . ',';
//                $desc .= $name .  '=>' . is_array($event->sender->getAttribute($name))?json_encode($event->sender->getAttribute($name)):$event->sender->getAttribute($name) . ',';
            }
            $desc = substr($desc, 0, -1);
        } else {
            $desc = '';
        }
        //管理员名称
        $userName = !empty(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:'admin';
        //修改的表名称
        $tableName = $event->sender->tableSchema->name;
        //var_dump($event->sender->getPrimaryKey());die;
        //event->sender->primaryKey()[0]   主键
        //$event->sender->getPrimaryKey()  新增id
        if(is_array($event->sender->getPrimaryKey())){
            $PrimaryKey = $event->sender->getPrimaryKey()[$event->sender->primaryKey()[0]];
        }else{
            $PrimaryKey = $event->sender->getPrimaryKey();
        }
        $description = sprintf($description, $userName, $tableName, $event->sender->primaryKey()[0], $PrimaryKey, $desc);

        $route = Url::to();
        /*if($event->name == yii\db\ActiveRecord::EVENT_AFTER_FIND){
            $description = "查看了：".$route;
        }*/
        $userId = Yii::$app->user->id;
        $ip = ip2long(Yii::$app->request->userIP);
        $data = [
            'route' => $route,
            'description' => $description,
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