<?php

use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PharmacieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pharmacies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Pharmacie',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'export' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user.profile.company',
            'name',
//            'latitude',
//            'longitude',
            // 'phone',
            // 'fax',
            // 'url:url',
            // 'email:email',
//             'region_id',
//             'city_id',
//             'district_id',
            // 'address',

            ['class' => ActionColumn::className()],
        ],
    ]); ?>

</div>
