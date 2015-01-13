<?php

use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DrugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                    'modelClass' => 'Post',
                ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'export' => false,
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'filter' => false,
                    'mergeHeader' => true,
                ],
                'name',
                [
                    'attribute' => 'content',
                    'filter' => false,
                    'mergeHeader' => true,
                    'format' => 'html',
                ],
                [
                    'attribute' => 'created_at',
                    'filter' => false,
                    'mergeHeader' => true,
                    'format' => 'datetime',
                ],
                ['class' => ActionColumn::className()],
            ],
        ]); ?>

</div>
