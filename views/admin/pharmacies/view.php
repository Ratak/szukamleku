<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pharmacie */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pharmacie', 'PHARMACIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacie-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('pharmacie', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('pharmacie', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('pharmacie', 'ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_ITEM?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'name',
            'latitude',
            'longitude',
            'phone',
            'fax',
            'url:url',
            'email:email',
            'region_id',
            'city_id',
            'district_id',
            'address',
        ],
    ]) ?>

</div>
