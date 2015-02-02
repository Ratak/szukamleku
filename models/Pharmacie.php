<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer  $id
 * @property integer  $user_id
 * @property integer  $region_id
 * @property integer  $city_id
 * @property integer  $district_id
 * @property string   $code
 * @property string   $name
 * @property string   $latitude
 * @property string   $longitude
 * @property string   $phone
 * @property string   $fax
 * @property string   $url
 * @property string   $email
 * @property string   $address
 *
 * @property Region   $region
 * @property City     $city
 * @property District $district
 * @property Drug[]   $drugs
 */
class Pharmacie extends ActiveRecord
{
    // *******************************************************************
    // * RELATIONS
    // *******************************************************************/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugs()
    {
        return $this->hasMany(Drug::className(), ['id' => 'drug_id'])
            ->viaTable(PharmaciesDrugs::tableName(), ['pharmacie_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pharmacies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['region_id', 'city_id', 'district_id'], 'integer'],
            [['code', 'name', 'phone', 'fax', 'url', 'email', 'address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attribuphoneabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'code'        => Yii::t('app', 'Code'),
            'name'        => Yii::t('app', 'Name'),
            'latitude'    => Yii::t('app', 'Latitude'),
            'longitude'   => Yii::t('app', 'Longitude'),
            'phone'       => Yii::t('app', 'phone'),
            'fax'         => Yii::t('app', 'Fax'),
            'url'         => Yii::t('app', 'Url'),
            'email'       => Yii::t('app', 'Email'),
            'region_id'   => Yii::t('app', 'Region ID'),
            'city_id'     => Yii::t('app', 'City ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'address'     => Yii::t('app', 'Address'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'user',
            'region',
            'city',
            'district',
            'drugs',
        ];
    }

    public static function findByCode($code)
    {
        return self::findOne(['code = :code', [':code' => $code]]);
    }
}
