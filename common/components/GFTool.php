<?php


namespace common\components;

/**
 * 游鱼的工具类
 */
class GFTool
{
    /*
     * microsecond 微秒     millisecond 毫秒
     *返回时间戳的毫秒数部分
     */
    public static function getMillisecond()
    {
        list($usec, $sec) = explode(" ", microtime());
        $msec=round($usec*1000);
        return $msec;
    }

    /**
     *  分转元 cent
     * @return float
     */
    public static function fenToYuan($value)
    {
        if($value == 0)return 0;
        return floor($value)/100;
    }

    /**
     * 元转分
     */
    public static function yuanToFen($value)
    {
        return floor($value*100);
    }

    public static function sendPost($url,$postData){
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
    /**
     * 设置水印
     */
    public static function setWater($imgSrc,$markImg,$markPos=9)
    {
//        返回一个具有四个单元的数组。索引 0 包含图像宽度的像素值，索引 1 包含图像高度的像素值。索引
// 2 是图像类型的标记：1 = GIF，2 = JPG，3 =PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 =TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 =JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM。这些标记与 PHP 4.3.0 新加的 IMAGETYPE 常量对应。索引 3 是文本字符串，内容为"height="yyy"width="xxx""，可直接用于 IMG 标记。
        $srcInfo = @getimagesize($imgSrc);

        $srcImg_w  = $srcInfo[0];

        $srcImg_h  = $srcInfo[1];

        switch ($srcInfo[2])
        {
            case 1:
                $srcim =imagecreatefromgif($imgSrc);
                break;
            case 2:
                $srcim =imagecreatefromjpeg($imgSrc);
                break;
            case 3:
                $srcim =imagecreatefrompng($imgSrc);
                break;
            default:
                die("不支持的图片文件类型");
                exit;
        }

        if(!file_exists($markImg) || empty($markImg))
        {
            return;
        }
        $markImgInfo = @getimagesize($markImg);
        $markImg_w  = $markImgInfo[0];
        $markImg_h  = $markImgInfo[1];
        if($srcImg_w < $markImg_w || $srcImg_h < $markImg_h)
        {
            return;
        }
        switch ($markImgInfo[2])
        {
            case 1:
                $markim =imagecreatefromgif($markImg);
                break;
            case 2:
                $markim =imagecreatefromjpeg($markImg);
                break;
            case 3:
                $markim =imagecreatefrompng($markImg);
                break;
            default:
                die("不支持的水印图片文件类型");
                exit;
        }
        $logow = $markImg_w;
        $logoh = $markImg_h;
        if($markPos == 0)
        {
            $markPos = rand(1, 9);
        }

        switch($markPos)
        {
            case 1:
                $x = +5;
                $y = +5;
                break;
            case 2:
                $x = ($srcImg_w - $logow) / 2;
                $y = +5;
                break;
            case 3:
                $x = $srcImg_w - $logow - 5;
                $y = +15;
                break;
            case 4:
                $x = +5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 5:
                $x = ($srcImg_w - $logow) / 2;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 6:
                $x = $srcImg_w - $logow - 5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 7:
                $x = +5;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 8:
                $x = ($srcImg_w - $logow) / 2;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 9:
                $x = $srcImg_w - $logow - 14;
                $y = $srcImg_h - $logoh -16;
                break;
            default:
                die("此位置不支持");
                exit;
        }
//        echo $markPos.'_'.$x.'_'.$y.'_'.$logoh.'_'.$logow.'_'.$srcImg_h;
        $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);
        imagecopy ( $dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);
        imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);

        imagedestroy($markim);

        switch ($srcInfo[2])
        {
            case 1:
                imagegif($dst_img, $imgSrc);
                break;
            case 2:
                imagejpeg($dst_img, $imgSrc,100);
                break;
            case 3:
                imagepng($dst_img, $imgSrc);
                break;
            default:
                die("不支持的水印图片文件类型");
                exit;
        }
//        $type = image_type_to_extension($srcInfo[2],false);
//        header('content-type:' . $srcInfo['mime']);
//        $func = "image{$type}";
//        $func($dst_img);

        imagedestroy($dst_img);
        imagedestroy($srcim);
    }

    public static function setWater2($imgSrc,$markImg)
    {
//指定图片路径

        $src = '001.png';

        //获取图片信息
        $info = getimagesize($src);

//获取图片扩展名

        $type = image_type_to_extension($info[2],false);

//动态的把图片导入内存中

        $fun = "imagecreatefrom{$type}";

        $image = $fun('001.png');

//指定字体颜色

        $col = imagecolorallocatealpha($image,255,255,255,50);

//指定字体内容

        $content = 'helloworld';

//给图片添加文字

        imagestring($image,5,20,30,$content,$col);

//指定输入类型

        header('Content-type:'.$info['mime']);

//动态的输出图片到浏览器中

        $func = "image{$type}";

        $func($image);

//销毁图片

        imagedestroy($image);
    }
    /**
     * 获取n位的随机字符串
     */
    public static function  getRandom( $param ){
        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ;
        $key  =  "" ;
        for ( $i =0; $i < $param ; $i ++)
        {
          $key  .=  $str {mt_rand(0,32)};     //生成php随机数
        }
        return  $key ;
    }   
    /**
     * 写入本地日志
     * GFTool::writeLog("--".$postData['UserMailInfo']['UserIDs']);
     */
    public static function writeLog($value){
        // $url = 'log/log.txt';
        $url = 'log/'.date("Y-m-d").'.txt';
        //$years = date('Y-m');
        $dir_name=dirname($url);
        //目录不存在就创建
        if(!file_exists($dir_name))
        {
            //iconv防止中文名乱码
            $res = mkdir(iconv("UTF-8", "GBK", $dir_name),0777,true);
        }
        $fp = fopen($url,"a");//打开文件资源通道 不存在则自动创建       
        fwrite($fp,date("Y-m-d H:i:s").':'.$value."\r\n");//写入文件
        fclose($fp);//关闭资源通
    }


}