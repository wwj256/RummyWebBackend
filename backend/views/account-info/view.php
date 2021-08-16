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
        <?= Html::a(Yii::t('app', 'UserBindInfo'), ['/user-bind-info/view', 'id' => $model->UserID], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserID',
            'SpreadID',
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
