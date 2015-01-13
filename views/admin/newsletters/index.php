<?php

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
        <?= Html::a(Yii::t('app', 'Create Newsletter'), ['create_newsletter'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'View Subscribers'), ['subscribers'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
