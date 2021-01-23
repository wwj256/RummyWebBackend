<?php
namespace backend\tools;

use Yii;
use yii\helpers\Html;

/**
 * APP 工具类
 * Class AppTool
 */
class AppTool
{
    public static function getUserScore($id)
    {
        $model = \backend\models\ScoreInfo::find()->select('*')->where('UserID='.$id)->one();
        if( !$model ) return '';
        return $model->Score;
    }

    public static function getMemName($id)
    {
        $model = \backend\models\Member::find()->select('nickname')->where('mid='.$id)->one();
        if( !$model ) return '';
        return $model->nickname;
    }

    public static function getMemPhone($id)
    {
        $model = \backend\models\Member::find()->select('phone')->where('mid='.$id)->one();
        if( !$model ) return '';
        return $model->phone;
    }

    public static function getMemBack($id)
    {
        $model = \backend\models\Membank::find()->select('bankno')->where('mid='.$id)->one();
        if( !$model ) return '';
        return $model->bankno;
    }

    public static function getMemBackName($id)
    {
        $model = \backend\models\Membank::find()->select('cardname')->where('mid='.$id)->one();
        if( !$model ) return '';
        return $model->cardname;
    }

    /**
     * 获取商品名字，根据商品ID
     * @param $id   商品ID
     */
    public static function getGoodsName($id)
    {
        $model = \backend\models\Goods::find()->select('wname')->where('gid='.$id)->one();
        if( !$model ) return '';
        return $model->wname;
    }

    public static function getAllImageStr($content)
    {
        if($content){
            $imgs = explode(",", $content);
            $htmlStr = '';
            foreach ($imgs as $key=>$value){
                $htmlStr = $htmlStr.Html::img(Yii::$app->params['domain'] .$value,
                        [
                            'width' => 350]
                    ).'<br>';
            }
            return $htmlStr;
        }else{
            return '';
        }
    }
}