<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\models\form;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use app\models\Language;

/**
 * @property integer     $id
 * @property integer     $language_id
 * @property integer     $user_id
 * @property string      $name
 * @property string      $content
 * @property string      $link_rewrite
 * @property string      $meta_keys
 * @property string      $meta_desc
 * @property string      $meta_title
 * @property integer     $updated_at
 * @property integer     $created_at
 */
class PostForm extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['name'], 'string'],
            [['content'], 'string'],

            [['file'], 'file', 'skipOnEmpty' => true, 'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],],

            [['language_id', 'user_id', 'updated_at', 'created_at'], 'integer'],

            ['language_id', 'default', 'value' => Language::getDefaultLang()->id],

            [['slug', 'meta_keys', 'meta_desc', 'meta_title'], 'string', 'max' => 255],
        ];
    }

    public static function tableName()
    {
        return '{{%pages}}';
    }

    public function behaviors()
    {
        return [
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('post_form', 'ID'),
            'language_id'         => Yii::t('post_form', 'ID_LANGUAGE'),
            'user_id'             => Yii::t('post_form', 'USER'),
            'name'                => Yii::t('post_form', 'POST_TITLE'),
            'content'             => Yii::t('post_form', 'DESCRIPTION'),
            'slug'                => Yii::t('post_form', 'POST_ALIAS_(_OPTIONAL_)'),
            'meta_keys'           => Yii::t('post_form', 'SEO_KEYWORDS'),
            'meta_desc'           => Yii::t('post_form', 'SEO_DESCRIPTION'),
            'meta_title'          => Yii::t('post_form', 'SEO_TITLE'),
            'updated_at'          => Yii::t('post_form', 'UPDATED_AT'),
            'created_at'          => Yii::t('post_form', 'CREATED_AT'),
        ];
    }
}
