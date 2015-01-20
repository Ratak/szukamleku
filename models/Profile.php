<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $phone
 * @property string  $fax
 * @property string  $legal_address
 * @property string  $postal_address
 * @property string  $krs
 *
 * @property User    $user
 */
class Profile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /* TODO */
        return [
            ['first_name',     'required', 'on' => ['signup']],
            ['first_name',     'string'],

            ['last_name',      'required', 'on' => ['signup']],
            ['last_name',      'string'],

            ['phone',          'required', 'on' => ['signup']],
            ['phone',          'string'],

            ['fax',            'string'],

            ['legal_address',  'required', 'on' => ['signup']],
            ['legal_address',  'string'],

            ['postal_address', 'required', 'on' => ['signup']],
            ['postal_address', 'string'],

            ['krs',            'required', 'on' => ['signup']],
            ['krs',            'string'],
        ];
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'signup'  => ['first_name', 'last_name', 'phone', 'fax', 'legal_address', 'postal_address', 'krs'],
            'create'  => ['first_name', 'last_name', 'phone', 'fax', 'legal_address', 'postal_address', 'krs'],
            'update'  => ['first_name', 'last_name', 'phone' ,'fax', 'legal_address', 'postal_address', 'krs'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'        => Yii::t('app', 'USER_ID'),
            'first_name'     => Yii::t('app', 'FIRST_NAME'),
            'last_name'      => Yii::t('app', 'LAST_NAME'),
            'phone'          => Yii::t('app', 'PHONE'),
            'fax'            => Yii::t('app', 'FAX'),
            'legal_address'  => Yii::t('app', 'LEGAL_ADDRESS'),
            'postal_address' => Yii::t('app', 'POSTAL_ADDRESS'),
            'krs'            => Yii::t('app', 'KRS'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
