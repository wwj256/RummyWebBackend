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
<div class="account-info-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->UserID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->UserID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此项吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserID',
            'SpreadID',
            'UniqueID',
            'Password',
            'NickName',
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
