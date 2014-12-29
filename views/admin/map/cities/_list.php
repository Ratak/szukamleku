<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use app\models\City;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $searchModel app\models\search\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo GridView::widget([
    'export' => false,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'name',
            'value' => function (City $model) {
                return Html::a($model->name, Url::to(['/admin/map/cities/view', 'id' => $model->id]));
            },
            'format'=>'html'
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
        ],
    ],
]);
