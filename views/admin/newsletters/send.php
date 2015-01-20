<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use app\models\User;

$this->title = Yii::t('app', 'Send Newsletter');
$this->params['breadcrumbs'][] = ['label' => Yii::t('newsletters', 'NEWSLETTER'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h3><?= $model->subject; ?></h3>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="alert alert-info">
                <?= Yii::t('newsletters', 'USERS_LIST'); ?>
            </div>

            <?= HTML::listBox('users_list',
                ArrayHelper::map(User::find()->where(['role_id' => User::ROLE_USER, 'status_id' => User::STATUS_ACTIVE])->all(),'id', 'id'),
                ArrayHelper::map(User::find()->where(['role_id' => User::ROLE_USER, 'status_id' => User::STATUS_ACTIVE])->all(),'id', 'email'),
                [
                    'class' => 'form-control',
                    'multiple' => true
                ]);
            ?>
            <hr/>
            <?= Html::submitButton('SEND', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="col-lg-12 col-xs-12">
                <?= $form->field($model, 'subject') ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= $form->field($model, 'content')->widget(CKEditor::className(),[
                        'editorOptions' => [
                            'preset' => 'full',
                            'inline' => false,
                        ],
                    ]);
                ?>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">

        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
