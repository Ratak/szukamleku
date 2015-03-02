<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        .titleblock {
            font-family: "Open-sans", sans-serif;
            color: #555454;
        }

        @media only screen and (max-width: 300px) {
            body {
                width: 218px !important;
                margin: auto !important;
            }

            .table {
                width: 195px !important;
                margin: auto !important;
            }

            .logo, .titleblock, .linkbelow, .box, .footer, .space_footer {
                width: auto !important;
                display: block !important;
            }

            span.title {
                font-size: 20px !important;
                line-height: 23px !important
            }

            span.subtitle {
                font-size: 14px !important;
                line-height: 18px !important;
                padding-top: 10px !important;
                display: block !important;
            }

            td.box p {
                font-size: 12px !important;
                font-weight: bold !important;
            }

            .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
                display: block !important;
            }

            .table-recap {
                width: 200px !important;
            }

            .table-recap tr td, .conf_body td {
                text-align: center !important;
            }

            .address {
                display: block !important;
                margin-bottom: 10px !important;
            }

            .space_address {
                display: none !important;
            }
        }

        @media only screen and (min-width: 301px) and (max-width: 500px) {
            body {
                width: 308px !important;
                margin: auto !important;
            }

            .table {
                width: 285px !important;
                margin: auto !important;
            }

            .logo, .titleblock, .linkbelow, .box, .footer, .space_footer {
                width: auto !important;
                display: block !important;
            }

            .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
                display: block !important;
            }

            .table-recap {
                width: 293px !important;
            }

            .table-recap tr td, .conf_body td {
                text-align: center !important;
            }

        }

        @media only screen and (min-width: 501px) and (max-width: 768px) {
            body {
                width: 478px !important;
                margin: auto !important;
            }

            .table {
                width: 450px !important;
                margin: auto !important;
            }

            .logo, .titleblock, .linkbelow, .box, .footer, .space_footer {
                width: auto !important;
                display: block !important;
            }
        }

        @media only screen and (max-device-width: 480px) {
            body {
                width: 308px !important;
                margin: auto !important;
            }

            .table {
                width: 285px;
                margin: auto !important;
            }

            .logo, .titleblock, .linkbelow, .box, .footer, .space_footer {
                width: auto !important;
                display: block !important;
            }

            .table-recap {
                width: 285px !important;
            }

            .table-recap tr td, .conf_body td {
                text-align: center !important;
            }

            .address {
                display: block !important;
                margin-bottom: 10px !important;
            }

            .space_address {
                display: none !important;
            }
        }
    </style>
    <?php $this->head() ?>
</head>
<body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>