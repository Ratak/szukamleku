<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer     $id
 * @property string      $name
 * @property integer     $city_id
 *
 * @property City        $city
 * @property Pharmacie[] $pharmacies
 */
class District extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%map_districts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'city_id' => Yii::t('app', 'City ID'),
        ];
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
    public function getPharmacies()
    {
        return $this->hasMany(Pharmacie::className(), ['district_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'city',
            'pharmacies',
        ];
    }
}
