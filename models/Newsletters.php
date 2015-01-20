<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Newsletters extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%newsletters}}';
    }

    public function rules()
    {
        return [
            [['subject', 'content'], 'required'],
            [['subject', 'content'], 'string'],

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
            'id'                  => Yii::t('newsletters', 'ID'),
            'subject'             => Yii::t('newsletters', 'NEWSLETTER_SUBJECT'),
            'content'             => Yii::t('newsletters', 'NEWSLETTER_DESCRIPTION'),
            'created_at'          => Yii::t('newsletters', 'CREATED_AT'),
            'updated_at'          => Yii::t('newsletters', 'UPDATED_AT'),
        ];
    }
}