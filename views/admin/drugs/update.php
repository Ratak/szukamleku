<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Drug */

$this->title = Yii::t('drug', 'UPDATE_DRUG: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('drug', 'DRUGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('drug', 'UPDATE');
?>
<div class="drug-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
