<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $profile app\models\Profile */

$this->title = Yii::t('app', 'UPDATE_USER: {email}', ['email' => $model->email]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user', 'UPDATE');
?>
<div class="user-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'   => $model,
        'profile' => $profile,
    ]) ?>
</div>
