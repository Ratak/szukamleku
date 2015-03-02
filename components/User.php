<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\components;

use app\models\Language;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @inheritdoc
 *
 * @property \app\models\User|\yii\web\IdentityInterface|null $identity The identity object associated with the currently logged-in user. null is returned if the user is not logged in (not authenticated).
 */
class User extends \yii\web\User
{
    public function getReturnUrl($defaultUrl = null)
    {
        $url = Yii::$app->getSession()->get($this->returnUrlParam, $defaultUrl);
        if (is_array($url)) {
            if (isset($url[0])) {
                return Yii::$app->getUrlManager()->createUrl($url);
            } else {
                $url = null;
            }
        }

        return Yii::$app->getUrlManager()->createUrl($url === null ? Yii::$app->getHomeUrl() : $url) ;
    }

    public function setReturnUrl($url)
    {
        $languages = ArrayHelper::getColumn(Language::getAllArray(), 'url');
        $parts = explode('/', $url);

        if(in_array($parts[1], $languages)){
            unset($parts[1]);
            $url = implode('/', $parts);
        }

        parent::setReturnUrl($url);
    }
}