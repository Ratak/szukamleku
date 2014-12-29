<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Drug */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drug-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name_international')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name_pharmaceutical')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'chemical_components')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'release_form')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'dosage')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'quantity_in_package')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
