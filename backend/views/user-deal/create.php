<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDeal */

$this->title = Yii::t('app', 'Add User Deal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Deals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-deal-create">

    <?php echo $model->UserID ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
