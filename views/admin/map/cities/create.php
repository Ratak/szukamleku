<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = Yii::t('map', 'ADD_CITY');
$this->params['breadcrumbs'][] = ['label' => Yii::t('map', 'CITIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'  => $model,
    ]) ?>

</div>
