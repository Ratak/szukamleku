<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="row">
    <div class="col-lg-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'profile.name',
                'profile.legal_address',
                'profile.postal_address',
            ],
        ]) ?>
    </div>
    <div class="col-lg-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'profile.krs',
                'profile.phone',
                'profile.fax',
            ],
        ]) ?>
    </div>
</div>