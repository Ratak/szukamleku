<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = Yii::t('map', 'UPDATE_REGION {region}', ['region' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('map', 'REGIONS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('map', 'UPDATE {region}', ['region' => $model->name]);
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
