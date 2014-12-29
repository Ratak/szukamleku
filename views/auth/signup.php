<?php

/* @var $this yii\web\View */
/* @var $model app\models\form\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('auth', 'SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="signup">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'email') ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'repassword')->passwordInput() ?>
                            <?= $form->field($model, 'krs') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'company') ?>
                            <?= $form->field($model, 'first_name') ?>
                            <?= $form->field($model, 'last_name') ?>
                            <?= $form->field($model, 'phone') ?>
                            <?= $form->field($model, 'fax') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'legal_address') ?>
                            <?= $form->field($model, 'postal_address') ?>
                            <?= $form->field($model, 'acept_legal')->checkbox() ?>
                        </div>
                    </div>

                <?= Html::submitButton(Yii::t('auth', 'BTN_SIGN_UP'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        <p class="text-center">
            <?= Html::a(Yii::t('auth', 'ALREADY_REGISTERED_SIGN_IN'), ['/guest/login']) ?>
        </p>
    </div>
</div>