<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pharmacie */

$this->title = Yii::t('pharmacie', 'UPDATE_PHARMACIE: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pharmacie', 'PHARMACIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('pharmacie', 'UPDATE');
?>
<div class="pharmacie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
