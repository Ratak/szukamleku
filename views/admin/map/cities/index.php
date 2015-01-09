<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $region app\models\Region|null */

if($region) {
    $this->title = Yii::t('map', 'CITY_IN {region}', ['region' => $region->name]);
    $this->params['breadcrumbs'][] = ['label' => Yii::t('map', 'CITIES'), 'url' => ['index']];
}
else {
    $this->title = Yii::t('map', 'CITIES');
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_list', [
        'searchModel'  => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
