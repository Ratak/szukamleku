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
            [['pharmacie_id', 'drug_id'], 'required'],
            [['pharmacie_id', 'drug_id', 'created_at'], 'integer']
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
}
