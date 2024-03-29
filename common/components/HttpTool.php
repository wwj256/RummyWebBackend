<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/13
 * Time: 18:42
 */

namespace common\components;

use Yii;

class HttpTool
{

    /**
     * 访问get
     * @param $url
     * @return mixed
     */
    public static function doGet($url)
    {
        \Yii::debug("get url".$url);
        //初始化
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        // 执行后不直接打印出来
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);

        //释放curl句柄
        curl_close($ch);

        return $output;
    }
    /**
     * 访问post
     * @param $url
     * @param $postData
     * @return mixed
     */
    public static function doPost($url,$postData){
        $postData = http_build_query($postData);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }

    public static function http_postRaw($url, $data_string) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 关闭SSL验证
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'X-AjaxPro-Method:ShowList',
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function sendSMS($phone, $needAddPre = 1)
    {
        $serverUrlStr = "";
        if( $needAddPre ){
            $serverUrlStr = Yii::$app->params['APIUrl']."houtai/sendsms?ph=%2B91{$phone}";
        }else{
            $serverUrlStr = Yii::$app->params['APIUrl']."houtai/sendsms?ph={$phone}";
        }
        // return $needAddPre."__".$serverUrlStr;
        $serverResponStr = self::doGet($serverUrlStr);
        $serverRespon = json_decode($serverResponStr);
        // echo $serverResponStr;
        // echo var_dump(property_exists($serverRespon, 'code2'));
        if( !property_exists($serverRespon, 'code') ){
            return "OTP Sending Error";
        }else if( $serverRespon->code != 0 ){//服务器加币如果不成功，打印错误内容
            return "OTP Sending Error code=$serverRespon->code, ".Yii::$app->params['errorCode'][$serverRespon->code];
        }
        return "1";
    }

    public static function deleteSMS($phone, $needAddPre = 1){
        $serverUrlStr = "";
        if( $needAddPre ){
            $serverUrlStr = Yii::$app->params['APIUrl']."houtai/delsms?ph=%2B91{$phone}";
        }else{
            $serverUrlStr = Yii::$app->params['APIUrl']."houtai/delsms?ph={$phone}";
        }
        self::doGet($serverUrlStr);
    }
}