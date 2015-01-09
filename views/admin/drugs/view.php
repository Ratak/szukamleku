<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Drug */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('drug', 'DRUGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('drug', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('drug', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('drug', 'ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_ITEM?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'name_international',
            'name_pharmaceutical',
            'chemical_components',
            'release_form',
            'dosage',
            'quantity_in_package',
            'manufacturer',
            [
                'attribute' => 'status_id',
                'value' => $model->status,
            ],
        ],
    ]) ?>

    <h3><?= Yii::t('drug', 'PHARMACIES') ?></h3>

    <?= GridView::widget([
        'export' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            'user.company',
            'name',
            // 'latitude',
            // 'longitude',
            // 'phone',
            // 'fax',
            // 'url:url',
            // 'email:email',
            // 'region_id',
            // 'city_id',
            // 'district_id',
            // 'address',
        ],
    ]); ?>

</div>
