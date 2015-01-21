<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Newsletters extends ActiveRecord
{
    /** Статус Нова Розсилка */
    const STATUS_NEW = 0;

    /** Статус Успішно надіслано */
    const STATUS_SUCCESS = 1;

    /** Статус Невдача при надсиланні */
    const STATUS_FAILED = 2;

    /**  @var string Читабельный статус пользователя. */
    private $_status;

    public static function tableName()
    {
        return '{{%newsletters}}';
    }

    public function rules()
    {
        return [
            [['subject', 'content'], 'required'],
            [['subject', 'content'], 'string'],

            // Статус [[status_id]]
            ['status_id', 'in',      'range' => array_keys( self::getStatusArray() )],
            ['status_id', 'default', 'value' => self::STATUS_NEW],

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
            'status_id'           => Yii::t('newsletters', 'SEND_STATUS'),
            'created_at'          => Yii::t('newsletters', 'CREATED_AT'),
            'updated_at'          => Yii::t('newsletters', 'UPDATED_AT'),
        ];
    }


    // *******************************************************************
    // * GETTERS
    // *******************************************************************/

    /**
     * Читабельный статус пользователя.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->_status === null)
            ? $this->_status = self::getStatusArray()[$this->getAttribute('status_id')]
            : $this->_status;
    }

    /**
     * Массив доступных статусов пользователя.
     *
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_NEW        => Yii::t('user', 'NEW'),
            self::STATUS_SUCCESS    => Yii::t('user', 'SEND_SUCCESS'),
            self::STATUS_FAILED     => Yii::t('user', 'SEND_FAILED'),
        ];
    }

    // *******************************************************************
    // * SETTERS
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        return $this->setAttribute('status_id', (int)$status);
    }
}