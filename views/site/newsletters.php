<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Subscribe for our newsletters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('userSubscribe')): ?>

        <div class="alert alert-success">
            <?= Yii::t('newsletters_form', 'YOU_HAVE_SUCCUESSFULLY_SUBSCRIBED_TO_OUR_UPDATES') ?>
        </div>

    <?php elseif (Yii::$app->session->hasFlash('userUnsubscribe')): ?>

        <div class="alert alert-success">
            <?= Yii::t('newsletters_form', 'YOU_HAVE_SUCCUESSFULLY_UNSUBSCRIBED_FROM_SUBSCRIBING_TO_OUR_UPDATES') ?>
        </div>

    <?php endif; ?>

    <?php $form = ActiveForm::begin([
            'options' => []
        ]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('newsletters_form', 'SUBSCRIBE') : Yii::t('newsletters_form', 'UNSUBSCRIBE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <code><?= __FILE__ ?></code>
</div>
