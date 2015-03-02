<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

use yii\helpers\Url;

/**
 * @var yii\web\View    $this
 * @var app\models\User $model
 */
?>
<table class="table table-mail"
       style="width:100%;margin-top:10px;-moz-box-shadow:0 0 5px #afafaf;-webkit-box-shadow:0 0 5px #afafaf;-o-box-shadow:0 0 5px #afafaf;box-shadow:0 0 5px #afafaf;filter:progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5)">
    <tr>
        <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
        <td align="center" style="padding:7px 0">
            <table class="table" bgcolor="#ffffff" style="width:100%">
                <tr>
                    <td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
                        <a title="SzukamLeku.pl" href="<?= Url::base(true) ?>" style="color:#337ff1">
                            <img src="<?= Url::to('img/mail_logo.png', true) ?>" alt="SzukamLeku.pl"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="titleblock" style="padding:7px 0">
                        <span class="title" style="font-weight:500;font-size:28px;text-transform:uppercase;line-height:33px">
                            <?= Yii::t('mail', 'HI_{fullName}', ['firstName' => $model->getFullName()]) ?>
                        </span>
                        <br/>
                        <span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">
                            <?= Yii::t('mail', 'THANK_YOU_FOR_CREATING_AN_ACCOUNT_AT_SZUKAMLEKU.PL') ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="space_footer" style="padding:0!important">&nbsp;</td>
                </tr>
                <tr>
                    <td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
                        <table class="table" style="width:100%">
                            <tr>
                                <td width="10" style="padding:7px 0">&nbsp;</td>
                                <td style="padding:7px 0">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
                                            <?= Yii::t('mail', 'YOUR_LOGIN_DETAILS') ?>
                                        </p>
                                        <span style="color:#777"> <?= Yii::t('mail', 'HERE_ARE_YOUR_LOGIN_DETAILS:') ?><br/>
                                            <span style="color:#333">
                                                <strong><?= Yii::t('mail', 'EMAIL_ADDRESS:') ?> <a href="mailto:<?= $model->email ?>" style="color:#337ff1"><?= $model->email ?></a></strong>
                                            </span>
                                            <br/>
                                            <span style="color:#333">
                                                <strong><?= Yii::t('mail', 'PASSWORD:') ?></strong> <?= $model->password ?>
                                            </span>
                                            <br/>
                                            <span style="color:#333">
                                                <strong><?= Yii::t('mail', 'COMPANY:') ?></strong> <?= $model->company ?>
                                            </span>
                                        </span>
                                    </font>
                                </td>
                                <td width="10" style="padding:7px 0">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="space_footer" style="padding:0!important">&nbsp;</td>
                </tr>
                <tr>
                    <td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
                        <table class="table" style="width:100%">
                            <tr>
                                <td width="10" style="padding:7px 0">&nbsp;</td>
                                <td style="padding:7px 0">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <p style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
                                            <?= Yii::t('mail', 'IMPORTANT_SECURITY_TIPS:') ?>
                                        </p>
                                        <ol style="margin-bottom:0">
                                            <li><?= Yii::t('mail', 'ALWAYS_KEEP_YOUR_ACCOUNT_DETAILS_SAFE') ?></li>
                                            <li><?= Yii::t('mail', 'NEVER_DISCLOSE_YOUR_LOGIN_DETAILS_TO_ANYONE') ?></li>
                                            <li><?= Yii::t('mail', 'CHANGE_YOUR_PASSWORD_REGULARLY') ?></li>
                                            <li><?= Yii::t('mail', 'SOMEONE_IS_USING_YOUR_ACCOUNT_ILLEGALLY_PLEASE_NOTIFY_US') ?>
                                            </li>
                                        </ol>
                                    </font>
                                </td>
                                <td width="10" style="padding:7px 0">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td class="space_footer" style="padding:0!important">&nbsp;</td>
                </tr>

                <tr>
                    <td class="space_footer" style="padding:0!important">&nbsp;</td>
                </tr>
                <tr>
                    <td class="footer" style="border-top:4px solid #333333;padding:7px 0">
                            <span>
                                <a href="<?= Url::base(true) ?>" style="color:#337ff1; font-size: 15px;">
                                    <?= Yii::t('mail', 'SHUKAMLEKU.PL&trade;') ?>
                                </a>
                            </span>
                    </td>
                </tr>
            </table>
        </td>
        <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
    </tr>
</table>