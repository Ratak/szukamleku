<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DrugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('banners', 'BANNERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('banners', 'Create {modelClass}', ['modelClass' => 'Banners',]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
