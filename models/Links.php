<?php

namespace app\models;

use Yii;
use app\models\Language;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Links extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%links}}';
    }

    public function rules()
    {
        return [
            [['name', 'link'], 'required'],
            [['name', 'link'], 'string'],

            [['language_id', 'created_at', 'updated_at'], 'integer'],

            ['language_id', 'default', 'value' => Language::getDefaultLang()->id],
        ];
    }

    public function behaviors()
    {
        return [
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
            'name'                => Yii::t('post_form', 'LINK_TITLE'),
            'link'                => Yii::t('post_form', 'LINK'),
            'created_at'          => Yii::t('post_form', 'CREATED_AT'),
            'updated_at'          => Yii::t('post_form', 'UPDATED_AT'),
        ];
    }

    public function getLink() {
        return $this->link;
    }
}