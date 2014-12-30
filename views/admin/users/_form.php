<?php

use app\models\User;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $profile app\models\Profile */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' => array_intersect_key(User::getStatusArray(), [User::STATUS_ACTIVE, User::STATUS_BANNED]),
    ]) ?>

    <?= $form->field($model, 'role_id')->widget(Select2::classname(), [
        'data' => User::getRoleArray(),
    ]) ?>

    <?= $form->field($model, 'email')->input('email', ['maxlength' => 100]) ?>

    <?= $form->field($profile, 'company')->textInput() ?>
    <?= $form->field($profile, 'first_name')->textInput() ?>
    <?= $form->field($profile, 'last_name')->textInput() ?>

    <?= $form->field($profile, 'phone')->input('tel') ?>
    <?= $form->field($profile, 'fax')->input('tel') ?>

    <?= $form->field($profile, 'legal_address')->textInput() ?>
    <?= $form->field($profile, 'postal_address')->textInput() ?>

    <?= $form->field($profile, 'krs')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>