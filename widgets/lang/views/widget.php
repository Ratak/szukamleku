<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use kartik\nav\NavX;

/* @var $this \yii\web\View */
/* @var $current \app\models\Language */
/* @var $langs \app\models\Language[] */

$items = [];
foreach($langs as $lang) {
    $items[] = ['label' => $lang['name'], 'url' => '/' . $lang['url'] . Yii::$app->request->getLanguageUrl()];
}
?>

<?= NavX::widget([
    'options'=>['class'=>'nav nav-pills'],
    'items' => [
        ['label' => $current->name, 'active' => true, 'items' => $items],
    ]
]);