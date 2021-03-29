<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\ActivityInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-info-form">

    <script type="text/javascript">
        function getBase64Image(img) {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, img.width, img.height);
            var ext = img.src.substring(img.src.lastIndexOf(".")+1).toLowerCase();
            var dataURL = canvas.toDataURL("image/"+ext);
            return dataURL;
        }

        //下面用于图片上传预览功能
        function setImagePreview(uploadType='en') {
            var filesList=document.getElementById("files-list");
            var obj = document.getElementById("upimage");
            var imgObjPreview = document.getElementById("preview");
            var src=event.target || window.event.srcElement; //获取事件源，兼容chrome/IE
            //下面把路径截取为文件名
            var filename=src.value;//图片完整路径
            var prefix=filename.substring( filename.lastIndexOf('\\')+1 );//获取文件名的前缀名（文件格式）
            var suffix=filename.substring( filename.lastIndexOf('.')+1).toLocaleLowerCase(); //获取文件名的后缀名（文件格式）
            console.log(filename);
            console.log(suffix);

            console.log( src.files )

            if(/image/.test(src.files[0].type)){
                const reader = new FileReader();
                reader.readAsDataURL(src.files[0]) // input.files[0]为第一个文件
                reader.onload = ()=>{
                    var img = document.getElementById('image_' +uploadType);
                    img.src = reader.result;
                    var base64 = reader.result.replace(/^data:\S+\/\S+;base64,/, '');
                    console.log(base64);
                    var iName = <?= "'a_$model->ID'" ?>;
                    // var iName = <?= "'a_$model->ID'" ?>+Math.random();
                    console.log(iName);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: <?php $apiUrl = Yii::$app->params['APIUrl']; echo "'{$apiUrl}image/Uploadlang'" ?>,
                        contentType: "application/json",
                        data:JSON.stringify({
                            "PreKey": "Lami*2020#zz",
                            "Type": 3,
                            "Name": iName,
                            "Data": base64,
                            "Lang":uploadType,
                        }),
                        success: function (result) {
                            console.log("data is :" + JSON.stringify(result) );
                            if (result.code == 0) {
                                var urlT = document.getElementById('activityinfo-url');
                                urlT.value = result.data.Url;
                                output.innerHTML="图片上传成功！";
                            }else {
                                output.innerHTML="图片上传失败，code=！"+result.code;
                                alert("图片上传失败，code=！"+result.code);
                            }
                        }
                    });
                }
            }else{
                alert("图片格式只能为jpg 或者 png");
            }
        }


    </script>

    <?php $form = ActiveForm::begin([
    'id' => 'activity-info-id',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'Tiltle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Url')->textInput(['placeholder'=>'点击下方选择文件，上传活动图片', 'readonly'=>true]) ?>
    <img id='image_en' src=<?php echo $model->Url ? Yii::$app->params['APIUrl']."image/downlang?url=$model->Url&lang=en" : '""' ?> style='width:300px'>
    <div class="form-group field-activityinfo-imageurl">
        <label class="control-label" for="activityinfo-imageurl">Upload en activity image.</label>
        <input type="hidden" name="ActivityInfo[imageUrl]" value="">
        <input type="file" id="activityinfo-imageurl" name="ActivityInfo[imageUrl]" onchange="setImagePreview('en')">
        <div id='output'>
        </div>
        <div class="help-block"></div>
    </div>
    <img id='image_in' src=<?php echo $model->Url ? Yii::$app->params['APIUrl']."image/downlang?url=$model->Url&lang=in" : '""' ?> style='width:300px'>
    <div class="form-group field-activityinfo-imageurl">
        <label class="control-label" for="activityinfo-imageurl">Upload in activity image.</label>
        <input type="hidden" name="ActivityInfo[imageUrl]" value="">
        <input type="file" id="activityinfo-imageurl" name="ActivityInfo[imageUrl]" onchange="setImagePreview('in')">
        <div id='output_in'>
        </div>
        <div class="help-block"></div>
    </div>
    <img id='image_ta' src=<?php echo $model->Url ? Yii::$app->params['APIUrl']."image/downlang?url=$model->Url&lang=ta" : '""' ?> style='width:300px'>
    <div class="form-group field-activityinfo-imageurl">
        <label class="control-label" for="activityinfo-imageurl">Upload ta activity image.</label>
        <input type="hidden" name="ActivityInfo[imageUrl]" value="">
        <input type="file" id="activityinfo-imageurl" name="ActivityInfo[imageUrl]" onchange="setImagePreview('ta')">
        <div id='output_ta'>
        </div>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'JumpTo')->textInput() ?>

    <?= $form->field($model, 'StartTime')->textInput() ?>

    <?= $form->field($model, 'EndTime')->textInput() ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
