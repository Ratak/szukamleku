<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $searchModel app\models\search\DistrictSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('map', 'REGIONS'), 'url' => ['/admin/map/regions']];
$this->params['breadcrumbs'][] = ['label' => $model->region->name, 'url' => ['/admin/map/regions/view', 'id' => 1]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode( Yii::t('map', 'DISTRICTS_IN {city}', ['city' => $this->title])) ?></h1>

    <p>
        <?= Html::a(Yii::t('map', 'ADD_DISTRICT'), ['/admin/map/districts/create', 'city' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('@app/views/admin/map/districts/_list', [
        'searchModel'  => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>
</div>
