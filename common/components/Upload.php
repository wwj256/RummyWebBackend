<?php
namespace common\components;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\base\Exception;
use yii\helpers\FileHelper;
/**
 * 文件上传处理
 */
class Upload extends Model
{
    public $file;
    private $_appendRules;
    public function init ()
    {
        parent::init();
        $extensions = Yii::$app->params['webuploader']['baseConfig']['accept']['extensions'];
        $this->_appendRules = [
            [['file'], 'file', 'extensions' => $extensions],
        ];
    }
    public function rules()
    {
        $baseRules = [];
        return array_merge($baseRules, $this->_appendRules);
    }
    /**
     *
     */
    public function upImage ($id,$name,$needWater=0)
    {
        $model = new static;
        $model->file = UploadedFile::getInstanceByName('file');
        if (!$model->file) {
            return false;
        }
        $relativePath = $successPath = '';

        if ($model->validate()) {

            $relativePath = Yii::$app->params['imageUploadRelativePath'.$id];
            $successPath = Yii::$app->params['imageUploadSuccessPath'.$id];
            $fileName = $model->file->baseName . '.' . $model->file->extension;
            if (!is_dir($relativePath)) {
                FileHelper::createDirectory($relativePath);
            }
            $index = strpos($fileName, '.');
            if( $name != '' ){
                $fileName = $name.substr($fileName,$index);
            }else{
                $fileName = date('YmdHis')."_".GFTool::getMillisecond().substr($fileName,$index);
            }
//            throw new \Exception($fileName.'第一次错误');die();
            $model->file->saveAs($relativePath . $fileName);
            if($needWater != 0)
                GFTool::setWater($relativePath . $fileName,'waterImg.png');
            return [
                'code' => 0,
                'url' => Yii::$app->params['domain'] . $successPath . $fileName,
                'attachment' => $successPath . $fileName
            ];
        } else {
            $errors = $model->errors;
            return [
                'code' => 1,
                'msg' => current($errors)[0]
            ];
        }
    }
}