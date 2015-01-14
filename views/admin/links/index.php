<?php

use kartik\grid\GridView;
use kartik\grid\ActionColumn;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DrugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => 'Links',]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'export' => false,
            'columns' => [
                [
                    'attribute' => 'id',
                    'filter' => false,
                    'mergeHeader' => true,
                ],
                'name',
                'link',
                [
                    'attribute' => 'created_at',
                    'filter' => false,
                    'mergeHeader' => true,
                    'format' => 'datetime',
                ],

                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>

</div>
