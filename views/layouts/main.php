<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use app\widgets\links\LinksWidget;
use app\widgets\lang\LanguageWidget;
use kartik\nav\NavX;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home',    'url' => ['/site/index']],
                    ['label' => 'Posts',   'url' => ['/site/posts']],
                    ['label' => 'About',   'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],

                    ['label' => 'User', 'items' => [
                        ['label' => 'Signup',       'url' => ['/auth/signup']],
                        ['label' => 'recover',      'url' => ['/auth/recover']],
                        ['label' => 'confirmation', 'url' => ['/auth/recover-confirmation']],
                    ]],

                    ['label' => 'Admin', 'url' => ['/admin'], 'visible' => Yii::$app->user->can('admin')],

                    Yii::$app->user->isGuest
                        ? ['label' => 'Login',  'url' => ['/auth/login']]
                        : ['label' => 'Logout', 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">

            <?= LanguageWidget::widget()?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
            <hr/>
            <?php /*= LinksWidget::widget()*/ ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
