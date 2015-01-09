<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = Yii::t('map', 'UPDATE_CITY: {city}', ['city' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('map', 'CITIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('map', 'UPDATE {city}', ['city' => $model->name]);
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
