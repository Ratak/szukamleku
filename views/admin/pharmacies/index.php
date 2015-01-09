<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PharmacieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('pharmacie', 'PHARMACIES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('pharmacie', 'CREATE_PHARMACIE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_list', [
        'searchModel'  => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
