<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PharmacieSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pharmacie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'fax') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'email') ?>

    <?php //= $form->field($model, 'region_id') ?>

    <?php //= $form->field($model, 'city_id') ?>

    <?php //= $form->field($model, 'district_id') ?>

    <?php //= $form->field($model, 'address') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('pharmacie', 'SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('pharmacie', 'RESET'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
