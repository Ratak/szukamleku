<?php

use app\models\Newsletters;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Newsletters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Newsletter'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'View Subscribers'), ['subscribers'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'export' => false,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'subject',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete} {send}',
                    'buttons' => [
                        'send' => function($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/newsletters/send', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-send"></span>', $url, [
                                'title' => Yii::t('newsletters','SEND_NEWSLETTER'),
                                'data-pjax' => '0',
                            ]);
                        }
                    ],
                ],
            ],
        ]);
    ?>
</div>
