<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

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
 * @property integer     $status_id
 *
 * @property string      $status
 *
 * @property Pharmacie[] $pharmacies
 */
class Drug extends ActiveRecord
{
    const STATUS_ADMITTED             = 1;
    const STATUS_ADMITTED_REMOVED     = 2;
    const STATUS_UNREGISTERED         = 3;
    const STATUS_UNREGISTERED_REMOVED = 4;
    const STATUS_EXPIRED              = 5;
    const STATUS_EXPIRED_REMOVED      = 6;

    const CACHE_KEY_RELEASE_FORM  = 'cache_key_release_form';
    const CACHE_KEY_DOSAGE        = 'cache_key_dosage';
    const CACHE_KEY_IN_PACKAGE    = 'cache_key_in_package';
    const CACHE_KEY_MANUFACTURER  = 'cache_key_manufacturer';
    const CACHE_KEY_FIRST_LETTERS = 'cache_key_first_letters';

    /** @var string Читабельный статус */
    private $_status;

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if(isset($changedAttributes['name'])) {
            Yii::$app->cache->delete(self::CACHE_KEY_FIRST_LETTERS);
        }

        if(isset($changedAttributes['release_form'])) {
            Yii::$app->cache->delete(self::CACHE_KEY_RELEASE_FORM);
        }

        if(isset($changedAttributes['dosage'])) {
            Yii::$app->cache->delete(self::CACHE_KEY_DOSAGE);
        }

        if(isset($changedAttributes['quantity_in_package'])) {
            Yii::$app->cache->delete(self::CACHE_KEY_IN_PACKAGE);
        }

        if(isset($changedAttributes['manufacturer'])) {
            Yii::$app->cache->delete(self::CACHE_KEY_MANUFACTURER);
        }
    }

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
            [['status_id'], 'integer'],
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
     * Массив доступных статусов
     *
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ADMITTED             => Yii::t('grug', 'ADMITTED'),
            self::STATUS_ADMITTED_REMOVED     => Yii::t('grug', 'ADMITTED_REMOVED'),
            self::STATUS_EXPIRED              => Yii::t('grug', 'TATUS_EXPIRED'),
            self::STATUS_EXPIRED_REMOVED      => Yii::t('grug', 'EXPIRED_REMOVED'),
            self::STATUS_UNREGISTERED         => Yii::t('grug', 'UNREGISTERED'),
            self::STATUS_UNREGISTERED_REMOVED => Yii::t('grug', 'UNREGISTERED_REMOVED'),
        ];
    }

    public static function getReleaseFormsArray()
    {
        $data = Yii::$app->cache->get(self::CACHE_KEY_RELEASE_FORM);

        if ($data === false) {
            $data = self::find()->select('release_form')->groupBy('release_form')->asArray()->all();
            $data = ArrayHelper::getColumn($data, 'release_form');
            $data = array_combine($data, $data);

            Yii::$app->cache->set(self::CACHE_KEY_RELEASE_FORM, $data);
        }

        return $data;
    }

    public static function getDosageArray()
    {
        $data = Yii::$app->cache->get(self::CACHE_KEY_DOSAGE);

        if ($data === false) {
            $data = self::find()->select('dosage')->groupBy('dosage')->asArray()->all();
            $data = ArrayHelper::getColumn($data, 'dosage');
            $data = array_combine($data, $data);

            Yii::$app->cache->set(self::CACHE_KEY_DOSAGE, $data);
        }

        return $data;
    }

    public static function getInPackageArray()
    {
        $data = Yii::$app->cache->get(self::CACHE_KEY_IN_PACKAGE);

        if ($data === false) {
            $data = self::find()->select('quantity_in_package')->groupBy('quantity_in_package')->asArray()->all();
            $data = ArrayHelper::getColumn($data, 'quantity_in_package');
            $data = array_combine($data, $data);

            Yii::$app->cache->set(self::CACHE_KEY_IN_PACKAGE, $data);
        }

        return $data;
    }

    public static function getManufacturerArray()
    {
        $data = Yii::$app->cache->get(self::CACHE_KEY_MANUFACTURER);

        if ($data === false) {
            $data = self::find()->select('manufacturer')->groupBy('manufacturer')->asArray()->all();
            $data = ArrayHelper::getColumn($data, 'manufacturer');
            $data = array_combine($data, $data);

            Yii::$app->cache->set(self::CACHE_KEY_MANUFACTURER, $data);
        }

        return $data;
    }

    public static function getFirstLetters()
    {
//        $data = Yii::$app->cache->get(self::CACHE_KEY_FIRST_LETTERS);

//        if ($data === false) {
            $data = (new Query())
                ->select(['DISTINCT LEFT(name, 1) as l'])
                ->from(self::tableName())
                ->all();

            $data = ArrayHelper::getColumn($data, 'l');

//        uksort($data, 'strcasecmp');
//        natsort($data);
//
//            Yii::$app->cache->set(self::CACHE_KEY_FIRST_LETTERS, $data);
//        }

        return $data;
    }

    /**
     * Читабельный статус
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->_status === null)
            ? $this->_status = self::getStatusArray()[$this->status_id]
            : $this->_status;
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
            'status_id'           => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        $fields = parent::fields();
        $fields['status'] = 'status';

        return $fields;
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
