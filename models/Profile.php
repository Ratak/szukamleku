<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property string  $company
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
            ['company', 'string'],
            ['first_name', 'string'],
            ['last_name', 'string'],
            ['phone', 'string'],
            ['fax', 'string'],
            ['legal_address', 'string'],
            ['postal_address', 'string'],
            ['krs', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'        => Yii::t('app', 'USER_ID'),
            'company'        => Yii::t('app', 'COMPANY'),
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
