<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('user', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('user', 'ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_ITEM?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'status',
            'role',
            'email:email',
            'created_at:date',
            'updated_at:date',
            'profile.first_name',
            'profile.last_name',
            'profile.phone',
            'profile.fax',
            'profile.legal_address',
            'profile.postal_address',
            'profile.krs',
        ],
    ]) ?>

</div>
