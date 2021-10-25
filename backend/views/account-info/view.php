<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountInfo */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => 'Account Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<script>
    function onResetMachineClick(uid) {
        console.log("/account-info/update-machine?id="+uid);
        $.post("/account-info/update-machine?id="+uid, function (data){
            alert(data);
            // window.location.reload();
        });
    } 
</script>
<div class="account-info-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->UserID], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', 'UserBindInfo'), ['/user-bind-info/view', 'id' => $model->UserID], ['class' => 'btn btn-primary']) ?>
        <?= html::button('ResetMachineID', ['id'=>'btn-danger','class'=>"btn btn-danger", 'onclick'=>'onResetMachineClick('. $model->UserID .')']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserID',
            'SpreadID',
            'InviteID',
            'PInviteID',
            'UniqueID',
            'Password',
            'NickName',
            'Status',
            'FaceUrl',
            'IsRobot',
            'Platform',
            'RegisterIP',
            'RegisterDate',
            'RegisterMachine',
            'ClientVersion',
            'LoginIP',
            'LoginDate',
            'LoginMachine',
        ],
    ]) ?>

</div>
