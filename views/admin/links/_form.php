<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'options' => []
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'link')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('links_form', 'CREATE') : Yii::t('post_form', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
