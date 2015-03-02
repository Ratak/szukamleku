<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property integer     $id
 * @property string      $name
 * @property integer     $region_id
 *
 * @property Region      $region
 * @property District[]  $districts
 * @property Pharmacie[] $pharmacies
 */
class City extends ActiveRecord
{
    const CACHE_KEY_ALL_CITIES = 'key_all_cities';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%map_cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'region_id' => Yii::t('app', 'Region ID'),
        ];
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
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacies()
    {
        return $this->hasMany(Pharmacie::className(), ['city_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'region',
        ];
    }

    /**
     * @return array
     */
    public static function getAllList()
    {
        $return = Yii::$app->cache->get(self::CACHE_KEY_ALL_CITIES);

        if ($return === false) {

            $return = self::find()->asArray()->all();
            $return = ArrayHelper::map($return, 'id', 'name');

            Yii::$app->cache->set(self::CACHE_KEY_ALL_CITIES, $return);
        }

        return $return;
    }
}
