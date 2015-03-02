<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string  $url
 * @property string  $local
 * @property string  $name
 * @property integer $default
 */
class Language extends ActiveRecord
{
    const CACHE_KEY_ALL_LANGUAGES        = 'cache_key_all_languages';
    const CACHE_KEY_ALL_LANGUAGES_BY_URL = 'cache_key_all_languages_by_url';
    const CACHE_KEY_ALL_LANGUAGES_EXCEPT = 'cache_key_all_languages_except';
    const CACHE_KEY_DEFAULT_LANGUAGE     = 'cache_key_default_language';
    const CACHE_DURATION = 60;

    /* @var Language Переменная, для хранения текущего объекта языка */
    static $current = null;

    public static function getAllArray($exceptCurrent = false)
    {
        $curent = Language::getCurrent()->id;
        $cacheKey = $exceptCurrent
            ? self::CACHE_KEY_ALL_LANGUAGES_EXCEPT . $curent
            : self::CACHE_KEY_ALL_LANGUAGES;

        $return = Yii::$app->cache->get($cacheKey);

        if ($return === false) {
            $return = Language::find();

            if($exceptCurrent) {
                $return->where('id != :current_id', [':current_id' => $curent]);
            }

            $return = $return->asArray()->all();

            Yii::$app->cache->set($cacheKey, $return);
        }

        return $return;
    }

    /**
     * Получение текущего объекта языка
     *
     * @return Language|array|null|ActiveRecord
     */
    public static function getCurrent()
    {
        if( self::$current === null ){
            self::$current = self::getDefaultLang();
        }

        return self::$current;
    }

    /**
     * Установка текущего объекта языка и локаль пользователя
     *
     * @param string|null $url
     */
    public static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->local;
    }

    /**
     * Получения объекта языка по умолчанию
     *
     * @return Language|null
     */
    public static function getDefaultLang()
    {
        $return = Yii::$app->cache->get(self::CACHE_KEY_DEFAULT_LANGUAGE);

        if ($return === false) {
            $return = Language::find()->where('`default` = :default', [':default' => 1])->one();

            Yii::$app->cache->set(self::CACHE_KEY_DEFAULT_LANGUAGE, $return);
        }

        return $return;
    }

    /**
     * Получения объекта языка по буквенному идентификатору
     *
     * @param string|null $url
     *
     * @return Language|null
     */
    public static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        }

        $cacheKey = self::CACHE_KEY_ALL_LANGUAGES_BY_URL . $url;

        $return = Yii::$app->cache->get($cacheKey);

        if ($return === false) {
            $return = Language::find()->where(['url' => $url])->one();

            if($return === null) return null;

            Yii::$app->cache->set($cacheKey, $return);
        }

        return $return;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%languages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'string', 'max' => 2],

            ['local', 'required'],
            ['local', 'string', 'max' => 5],

            ['name', 'required'],
            ['name', 'string', 'max' => 30],

            ['default', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('app', 'ID'),
            'url'     => Yii::t('app', 'Url'),
            'local'   => Yii::t('app', 'Local'),
            'name'    => Yii::t('app', 'Name'),
            'default' => Yii::t('app', 'Default'),
        ];
    }

    public function afterInsert()
    {
        self::flushCache();
    }

    public function afterUpdate()
    {
        self::flushCache();
    }

    protected static function flushCache()
    {
        Yii::$app->cache->delete(self::CACHE_KEY_ALL_LANGUAGES);
        Yii::$app->cache->delete(self::CACHE_KEY_ALL_LANGUAGES_BY_URL);
        Yii::$app->cache->delete(self::CACHE_KEY_ALL_LANGUAGES_EXCEPT);
    }
}
