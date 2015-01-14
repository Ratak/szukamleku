<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $profile app\models\Profile */

$this->title = Yii::t('user', 'CREATE_USER');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'   => $model,
        'profile' => $profile,
    ]) ?>

</div>
