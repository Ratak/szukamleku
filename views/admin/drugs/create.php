<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Drug */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Drug',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Drugs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
