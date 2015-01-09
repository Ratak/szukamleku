<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Drug */

$this->title = Yii::t('drug', 'ADD_DRUG');
$this->params['breadcrumbs'][] = ['label' => Yii::t('drug', 'DRUGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
