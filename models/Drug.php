<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer     $id
 * @property string      $name
 * @property string      $name_international
 * @property string      $name_pharmaceutical
 * @property string      $chemical_components
 * @property string      $release_form
 * @property string      $dosage
 * @property string      $quantity_in_package
 * @property string      $manufacturer
 * @property integer     $status
 *
 * @property Pharmacie[] $pharmacies
 */
class Drug extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%drugs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'name_international', 'name_pharmaceutical', 'chemical_components', 'release_form', 'dosage', 'quantity_in_package', 'manufacturer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacies()
    {
        return $this->hasMany(Pharmacie::className(), ['id' => 'pharmacie_id'])
            ->viaTable(PharmaciesDrugs::tableName(), ['drug_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('app', 'ID'),
            'name'                => Yii::t('app', 'Name'),
            'name_international'  => Yii::t('app', 'Name International'),
            'name_pharmaceutical' => Yii::t('app', 'Name Pharmaceutical'),
            'chemical_components' => Yii::t('app', 'Chemical Components'),
            'release_form'        => Yii::t('app', 'Release Form'),
            'dosage'              => Yii::t('app', 'Dosage'),
            'quantity_in_package' => Yii::t('app', 'Quantity In Package'),
            'manufacturer'        => Yii::t('app', 'Manufacturer'),
            'status'              => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'pharmacies',
        ];
    }
}
