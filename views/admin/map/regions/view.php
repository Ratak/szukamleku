<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */
/* @var $searchModel app\models\search\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode( Yii::t('app', 'Cities in {region} region', ['region' => $this->title])) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['/admin/map/cities/create', 'region' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('@app/views/admin/map/cities/_list', [
        'searchModel'  => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>
</div>
