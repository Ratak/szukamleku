<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pharmacie */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pharmacie',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pharmacies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
