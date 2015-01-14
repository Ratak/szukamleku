<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
    <div class="row">
        <div class="col-xs-12 col-lg-8">
            <?= $form->field($model, 'content')->widget(CKEditor::className(),[
                    'editorOptions' => [
                    'preset' => 'full',
                    'inline' => false,
                    ],
                ]);
            ?>
        </div>

        <div class="col-xs-12 col-lg-4 pull-right">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('post_form', 'SEO_PARAMS'); ?></div>
        <div class="panel-body">
            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'meta_keys')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('post_form', 'CREATE'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
