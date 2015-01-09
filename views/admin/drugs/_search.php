<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\DrugSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drug-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_international') ?>

    <?= $form->field($model, 'name_pharmaceutical') ?>

    <?= $form->field($model, 'chemical_components') ?>

    <?php // echo $form->field($model, 'release_form') ?>

    <?php // echo $form->field($model, 'dosage') ?>

    <?php // echo $form->field($model, 'quantity_in_package') ?>

    <?php // echo $form->field($model, 'manufacturer') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('drug', 'SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('drug', 'RESET'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
