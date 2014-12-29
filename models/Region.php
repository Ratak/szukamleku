<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property integer     $id
 * @property string      $name
 *
 * @property City[]      $cities
 * @property Pharmacie[] $pharmacies
 */
class Region extends ActiveRecord
{
    const CACHE_KEY_ALL_REGIONS = 'key_all_regions';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%map_regions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacies()
    {
        return $this->hasMany(Pharmacie::className(), ['region_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getAllList()
    {
        $return = Yii::$app->cache->get(self::CACHE_KEY_ALL_REGIONS);

        if ($return === false) {

            $return = self::find()->asArray()->all();
            $return = ArrayHelper::map($return, 'id', 'name');

            Yii::$app->cache->set(self::CACHE_KEY_ALL_REGIONS, $return);
        }

        return $return;
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'cities',
            'pharmacies',
        ];
    }

}
