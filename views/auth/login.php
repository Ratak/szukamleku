<?php

/* @var $model app\models\form\LoginForm*/
/* @var $this  yii\web\View */
/* @var $form  yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('auth', 'FRONTEND_LOGIN_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?php echo Html::encode($this->title); ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <div class="row">
            <div class="col-sm-6">
                <?= Html::submitButton(Yii::t('auth', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
                &nbsp;
                <?= Yii::t('auth', 'OR') ?>
                &nbsp;
                <?= Html::a(Yii::t('auth', 'RECOVERY'), ['recover']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>