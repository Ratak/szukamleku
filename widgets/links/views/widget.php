<?php

use yii\helpers\Html;

echo Html::beginTag('div', ['class' => 'links_title']);
    echo Yii::t('links_form', 'ADDITIONAL_LINKS');
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'links_wrapper']);
    foreach($links as $link) {
        echo Html::a($link->name, $link->link, ['class' => 'btn-link-'.rand(0, 10), 'target' => '_blank']);
    }
echo Html::endTag('div');
