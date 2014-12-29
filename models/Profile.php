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
            [['first_name', 'last_name', 'phone'], 'required'],
            [['first_name', 'last_name', 'phone'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'        => Yii::t('app', 'User ID'),
            'company'        => Yii::t('app', 'Company'),
            'first_name'     => Yii::t('app', 'First Name'),
            'last_name'      => Yii::t('app', 'Last Name'),
            'phone'          => Yii::t('app', 'Phone'),
            'fax'            => Yii::t('app', 'Fax'),
            'legal_address'  => Yii::t('app', 'Legal Address'),
            'postal_address' => Yii::t('app', 'Postal Address'),
            'krs'            => Yii::t('app', 'Postal Address'),
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
