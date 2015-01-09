<?php

use app\models\Drug;
use kartik\widgets\Select2;
use kartik\widgets\Typeahead;
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

    <?= $form->field($model, 'release_form')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => Drug::getReleaseFormsArray(),
                'limit' => 10
            ]
        ],
        'pluginOptions' => ['highlight'=>true],
    ]) ?>

    <?= $form->field($model, 'dosage')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => Drug::getDosageArray(),
                'limit' => 10
            ]
        ],
        'pluginOptions' => ['highlight'=>true],
    ]) ?>

    <?= $form->field($model, 'quantity_in_package')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => Drug::getInPackageArray(),
                'limit' => 10
            ]
        ],
        'pluginOptions' => ['highlight'=>true],
    ]) ?>

    <?= $form->field($model, 'manufacturer')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => Drug::getManufacturerArray(),
                'limit' => 10
            ]
        ],
        'pluginOptions' => ['highlight'=>true],
    ]) ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' => Drug::getStatusArray(),
    ]) ?>

    <div class="form-group">
        <?= ($model->isNewRecord)
            ? Html::submitButton( Yii::t('drug', 'ADD'), ['class' => 'btn btn-success'])
            : Html::submitButton( Yii::t('drug', 'UPDATE'), ['class' => 'btn btn-primary'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
