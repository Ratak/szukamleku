<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use app\widgets\lang\LanguageWidget;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name . ' admin',
        'brandUrl' => Yii::$app->homeUrl . 'admin',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Drugs',      'url' => ['/admin/drugs']],
            ['label' => 'Pharmacies', 'url' => ['/admin/pharmacies']],
            ['label' => 'Users',      'url' => ['/admin/users']],
            ['label' => 'Map', 'items' => [
                ['label' => 'Regions',   'url' => ['/admin/map/regions']],
                ['label' => 'Cities',    'url' => ['/admin/map/cities']],
                ['label' => 'Districts', 'url' => ['/admin/map/districts']],
            ]],
            ['label' => 'Posts',      'url' => ['/admin/post']],
            ['label' => 'Links',      'url' => ['/admin/links']],
            ['label' => 'Newsletter', 'url' => ['/admin/newsletters']],
            ['label' => 'Banners',    'url' => ['/admin/banners']],
            ['label' => 'Logout',     'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']]
        ]
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= LanguageWidget::widget()?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>