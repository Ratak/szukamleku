<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer   $id
 * @property integer   $statistic_id
 * @property integer   $user_id
 * @property string    $ip
 * @property integer   $created_at
 *
 * @property Statistic $statistic
 * @property User      $user
 */
class StatisticExtend extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statistics_extend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statistic_id', 'user_id', 'created_at'], 'integer'],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatistic()
    {
        return $this->hasOne(Statistic::className(), ['id' => 'statistic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('statistic', 'ID'),
            'statistic_id' => Yii::t('statistic', 'STATISTIC_ID'),
            'user_id'      => Yii::t('statistic', 'USER_ID'),
            'ip'           => Yii::t('statistic', 'IP'),
            'created_at'   => Yii::t('statistic', 'CREATED_AT'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->garbageCollector();
    }

    protected function garbageCollector()
    {
        if (mt_rand(1, 2) == 1) {
            self::deleteAll('created_at < :created_at', [':created_at' => time() - 24 * 60 * 60]);
        }
    }
}
