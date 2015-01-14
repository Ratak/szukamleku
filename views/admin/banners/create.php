<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Drug */

$this->title = Yii::t('app', 'Create {modelClass}', [
        'modelClass' => 'Banners',
    ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('banners', 'BANNERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
