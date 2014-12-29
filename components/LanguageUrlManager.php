<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\components;

use app\models\Language;
use yii\web\UrlManager;

class LanguageUrlManager extends UrlManager
{
    /**
     * @inheritdoc
     */
    public function createUrl($params)
    {
        if (isset($params['lang_id'])) {
            //Если указан идентификатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию
            $language = Language::findOne($params['lang_id']);
            if ($language === null) {
                $language = Language::getDefaultLang();
            }
            unset($params['lang_id']);
        }
        else {
            //Если не указан параметр языка, то работаем с текущим языком
            $language = Language::getCurrent();
        }

        //Получаем сформированный URL(без префикса идентификатора языка)
        $url = parent::createUrl($params);

        //Добавляем к URL префикс - буквенный идентификатор языка
        return ($url == '/')
            ? '/' . $language->url
            : '/' . $language->url . $url;
    }
}