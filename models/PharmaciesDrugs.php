<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer   $pharmacie_id
 * @property integer   $drug_id
 * @property integer   $created_at
 *
 * @property Drug      $drug
 * @property Pharmacie $pharmacie
 */
class PharmaciesDrugs extends ActiveRecord
{
    const SCENARIO_IMPORT = 'import';

    public $pharmacieCode;
    public $drugName;
    public $manufacturer;
    public $price;
    public $quantity;
    public $date;

    /* var Pharmacie $importPharmacie */
    protected $importPharmacie;

    /* var Drug $importDrug */
    protected $importDrug;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pharmacies_drugs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // pharmacieCode
            ['pharmacieCode', 'trim'],
            ['pharmacieCode', 'required',              'on' => [self::SCENARIO_IMPORT]],
            ['pharmacieCode', 'validatePharmacieCode', 'on' => [self::SCENARIO_IMPORT]],

            // pharmacie_id
            ['pharmacie_id', 'default', 'on' => [self::SCENARIO_IMPORT], 'value' => $this->getPharmacieId()],
            ['pharmacie_id', 'required'],
            ['pharmacie_id', 'integer'],

            // drugName
            ['drugName', 'trim'],
            ['drugName', 'required',         'on' => [self::SCENARIO_IMPORT]],
            ['drugName', 'validateDrugName', 'on' => [self::SCENARIO_IMPORT]],

            // drug_id
            ['drug_id', 'default', 'on' => [self::SCENARIO_IMPORT], 'value' => $this->getDrugId()],
            ['drug_id', 'required'],
            ['drug_id', 'integer'],

            // manufacturer
            ['manufacturer', 'trim'],

            // price
            ['price', 'trim'],
            ['price', 'required', 'on' => [self::SCENARIO_IMPORT]],

            // quantity
            ['quantity', 'trim'],
            ['quantity', 'required', 'on' => [self::SCENARIO_IMPORT]],

            // date
            ['date', 'trim'],
            ['date', 'required', 'on' => [self::SCENARIO_IMPORT]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pharmacie_id' => Yii::t('app', 'Pharmacie ID'),
            'drug_id'      => Yii::t('app', 'Drug ID'),
            'created_at'   => Yii::t('app', 'Created At'),
        ];
    }

    public function validatePharmacieCode($attribute)
    {
        if (!self::getPharmacieByCode()) {
            $this->addError($attribute, 'Pharmacie code invalid');
        }
    }

    public function validateDrugName($attribute)
    {
        if (!self::getDrugByName()) {
            $this->addError($attribute, 'Drug name invalid');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrug()
    {
        return $this->hasOne(Drug::className(), ['id' => 'drug_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacie()
    {
        return $this->hasOne(Pharmacie::className(), ['id' => 'pharmacie_id']);
    }

    public function getDrugByName()
    {
        if(!$this->importDrug) {
            $this->importDrug = Pharmacie::findByCode($this->drugName);
        }

        return $this->importDrug;
    }

    public function getPharmacieByCode() {
        if(!$this->importPharmacie) {
            $this->importPharmacie = Pharmacie::findByCode($this->pharmacieCode);
        }

        return $this->importPharmacie;
    }

    public function getPharmacieId() {
        return ($pharmacie = $this->getPharmacieByCode())
            ? $pharmacie->id
            : null;
    }

    public function getDrugId() {
        return ($drug = $this->getDrugByName())
            ? $drug->id
            : null;
    }
}
