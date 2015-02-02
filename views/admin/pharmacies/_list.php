<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PharmacieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?= GridView::widget([
    'export' => false,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'user.company',
        'code',
        'name',
        // 'latitude',
        // 'longitude',
        // 'phone',
        // 'fax',
        // 'url:url',
        // 'email:email',
        // 'region_id',
        // 'city_id',
        // 'district_id',
        // 'address',

        ['class' => ActionColumn::className()],
    ],
]); ?>