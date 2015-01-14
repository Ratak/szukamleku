<?php

use app\models\User;
use kartik\grid\ActionColumn;
use kartik\grid\ExpandRowColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'USERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'CREATE_USER'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'rowOptions' => function (User $model) {
            switch($model->status_id) {
                case User::STATUS_ACTIVE :
                    return ['class' => 'success'];
                case User::STATUS_BANNED :
                    return ['class' => 'danger'];
                case User::STATUS_INACTIVE :
                    return ['class' => 'warning'];
                default:
                    return null;
            }

        },
        'columns' => [
            [
                'class' => ExpandRowColumn::className(),
                'value' => function () {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => Url::to(['expand-row']),
                'detailAnimationDuration' => 0
            ],
            [
                'attribute' => 'email',
            ],
            [
                'filter'    => true,
                'attribute' => 'company',
            ],
            [
                'filter'              => User::getStatusArray(),
                'filterType'          => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [ 'pluginOptions' => [ 'allowClear' => true ] ],
                'filterInputOptions'  => [ 'placeholder' => Yii::t('user', 'ANY') ],
                'attribute'           => 'status_id',
                'value'               => 'status',
            ],
            [
                'filter'              => User::getRoleArray(),
                'filterType'          => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
                'filterInputOptions'  => ['placeholder' => Yii::t('user', 'ANY')],
                'attribute'           => 'role_id',
                'value'               => 'role',
            ],
            [
                'filter'      => false,
                'mergeHeader' => true,
                'attribute'   => 'created_at',
                'width'       => '150px',
                'value'       => function(User $model){ return date("d.m.Y H:m:s", $model->created_at); }
            ],
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>

</div>
