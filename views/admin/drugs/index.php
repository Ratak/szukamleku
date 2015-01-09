<?php

use app\models\Drug;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DrugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('drug', 'DRUGS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('drug', 'ADD_DRUG'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'export' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'           => 'release_form',
                'filter'              => Drug::getReleaseFormsArray(),
            ],
            [
                'attribute' => 'name',
                'format'    => 'html',
                'value'     => function(Drug $model){
                    $html = ($model->name_international)
                        ? Html::tag('h6', Yii::t('drug', 'INTERNATIONAL: {name}', ['name' => $model->name_international]))
                        : null;
                    $html .= ($model->name_pharmaceutical)
                        ? Html::tag('h6', Yii::t('drug', 'PHARMACEUTICAL: {name}', ['name' => $model->name_pharmaceutical]))
                        : null;
                    return Html::a($model->name, ['view', 'id' => $model->id]) . $html;
                }
            ],
            'manufacturer',
            [
                'format' => 'html',
                'value'  => function(Drug $model){
                    $html =( ! $model->chemical_components) ? null :
                        '<h6>' . Html::tag('strong', Yii::t('drug', 'COMPONENTS:')) . ' ' . $model->chemical_components . '</h6>';
                    $html .= ( ! $model->dosage) ? null :
                        '<h6>' . Html::tag('strong', Yii::t('drug', 'DOSAGE: ')) . ' ' . $model->dosage . '</h6>';
                    $html .= ( ! $model->quantity_in_package) ? null :
                        '<h6>' . Html::tag('strong', Yii::t('drug', 'IN_PACKAGE: ')) . ' ' . $model->quantity_in_package . '</h6>';
                    return $html;
                }
            ],
            [
                'attribute' => 'status_id',
                'filter'    => Drug::getStatusArray(),
                'format'    => 'html',
                'value'     => function(Drug $model) {
                    switch($model->status_id) {
                        case Drug::STATUS_ADMITTED :
                            return Html::tag('p', Yii::t('drug', 'ADMITTED'), ['class' => 'label label-primary']);
                        case Drug::STATUS_EXPIRED :
                            return Html::tag('p', Yii::t('drug', 'EXPIRED'), ['class' => 'label label-warning']);
                        case Drug::STATUS_UNREGISTERED :
                            return Html::tag('p', Yii::t('drug', 'UNREGISTERED'), ['class' => 'label label-default']);
                        case Drug::STATUS_ADMITTED_REMOVED :
                            return Html::tag('p', Yii::t('drug', 'ADMITTED'), ['class' => 'label label-primary']) .
                                   '<br>' .
                                   Html::tag('p', Yii::t('drug', 'REMOVED'), ['class' => 'label label-danger']);
                        case Drug::STATUS_EXPIRED_REMOVED :
                            return Html::tag('p', Yii::t('drug', 'EXPIRED'), ['class' => 'label label-warning']) .
                                   '<br>' .
                                   Html::tag('p', Yii::t('drug', 'REMOVED'), ['class' => 'label label-danger']);
                        case Drug::STATUS_UNREGISTERED_REMOVED :
                            return Html::tag('p', Yii::t('drug', 'UNREGISTERED'), ['class' => 'label label-default']) .
                                   '<br>' .
                                   Html::tag('p', Yii::t('drug', 'REMOVED'), ['class' => 'label label-danger']);
                        default:
                            return '';
                    }
                },
            ],
            [
                'class'    => ActionColumn::className(),
                'header'   => false,
                'width'    => '50px',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>
