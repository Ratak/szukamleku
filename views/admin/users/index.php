<?php

use app\models\User;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
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
                default:
                    return $model->id === Yii::$app->user->identity->id ? ['class' => 'info'] : '';
            }
        },
        'columns' => [
            [
                'attribute' => 'email',
            ],
            [
                'attribute' => 'profile.company',
            ],
            [
                'filter'              => User::getStatusArray(),
                'filterType'          => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [ 'pluginOptions' => [ 'allowClear' => true ] ],
                'filterInputOptions'  => [ 'placeholder' => Yii::t('app', 'Any status') ],
                'attribute'           => 'status_id',
                'value'               => 'status',
            ],
            [
                'filter'      => false,
                'mergeHeader' => true,
                'attribute'   => 'role_id',
                'value'       => 'role',
            ],
            [
                'filter'      => false,
                'mergeHeader' => true,
                'attribute'   => 'created_at',
                'value'       => 'createdDate',
            ],
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>

</div>
