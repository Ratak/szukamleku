<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use app\assets\ImportAsset;
use yii\helpers\Html;

ImportAsset::register($this);
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
<body class="container">
<?php $this->beginBody() ?>

<form class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="inputfile" placeholder="file">
        </div>
    </div>
</form>



<div class="progress" style="display: none">
    <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>