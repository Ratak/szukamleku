<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Banners extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%banners}}';
    }

    public function rules()
    {
        return [
            [['name', 'link'], 'required'],
            [['name'], 'string'],
            [['link'], 'url'],

            [['content'], 'string'],

            [['image'], 'file', 'skipOnEmpty' => true, 'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],],

            [['created_at', 'updated_at'], 'integer'],
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
            'id'                  => Yii::t('banners', 'ID'),
            'name'                => Yii::t('banners', 'NAME'),
            'link'                => Yii::t('banners', 'LINK'),
            'content'             => Yii::t('banners', 'BANNER_DESCRIPTION'),
            'image'               => Yii::t('banners', 'IMAGE'),
            'created_at'          => Yii::t('banners', 'CREATED_AT'),
            'updated_at'          => Yii::t('banners', 'UPDATED_AT'),
        ];
    }

    public function extraFields()
    {
        return [
            'name',
            'link',
            'content',
            'image'
        ];
    }
}