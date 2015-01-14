<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\StringHelper;

/**
 * @property integer $id
 * @property string  $model_name
 * @property integer $model_id
 * @property integer $unique
 * @property integer $non_unique
 * @property integer $created_at
 *
 * @property StatisticExtend $extended
 */
class Statistic extends ActiveRecord
{
    const CACHE_TOTAL_KEY = 'cache_total_key';
    const CACHE_TOTAL_DURATION = 360;

    const CACHE_POPULAR_KEY = 'cache_popular_key';
    const CACHE_POPULAR_DURATION = 360;

    const CACHE_POPULAR_DRUGS_KEY = 'cache_popular_drugs_key';
    const CACHE_POPULAR_DRUGS_DURATION = 360;

    const CACHE_POPULAR_PHARMACIES_KEY = 'cache_popular_pharmacies_key';
    const CACHE_POPULAR_PHARMACIES_DURATION = 360;

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
            'counterUnique' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'unique',
                ],
                'value' => function(){
                    return $this->getIsUniqueUser() ? ++$this->unique : $this->unique;
                }
            ],
            'counterNonUnique' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'non_unique',
                ],
                'value' => function(){
                    return ++$this->non_unique;
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'unique', 'non_unique', 'created_at'], 'integer'],
            [['model_name'], 'string', 'max' => 255],
            [['model_name', 'model_id', 'created_at'], 'unique', 'targetAttribute' => ['model_name', 'model_id', 'created_at'], 'message' => 'The combination of Model Name, Model ID and Date has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtended()
    {
        return $this->hasMany(StatisticExtend::className(), ['statistic_id' => 'id']);
    }

    public function getIsUniqueUser()
    {
        $hasExtended = $this->getExtended()
            ->where('ip = :ip', [':ip' => Yii::$app->request->getUserIP()])
            ->andWhere('created_at > :created_at', [':created_at' => time() - 24 * 60 * 60])
            ->one();

        return (!$hasExtended);
    }

    public static function getTotal()
    {
        $return = Yii::$app->cache->get(self::CACHE_TOTAL_KEY);

        if ($return === false) {

            $dayInterval = time() - 24 * 60 * 60;
            $table = self::tablename();

            $sql = "SELECT SUM(`unique`) AS totalUnique, SUM(`non_unique`) AS totalNonUnique FROM $table";
            $total = Yii::$app->getDb()->createCommand($sql)
                ->queryOne();

            $sql = "SELECT SUM(`unique`) AS dayUnique, SUM(`non_unique`) AS dayNonUnique FROM $table WHERE created_at > :created_at";
            $day = Yii::$app->getDb()->createCommand($sql)
                ->bindParam(':created_at', $dayInterval)
                ->queryOne();

            $return = array_merge($total, $day);

            Yii::$app->cache->set(self::CACHE_TOTAL_KEY, $return, self::CACHE_TOTAL_DURATION);
        }

        return array_map('intval', $return);
    }

    public static function getPopularDrugs($limit)
    {
        $return = Yii::$app->cache->get(self::CACHE_POPULAR_DRUGS_KEY);

        if ($return === false) {
            $totalQuery = self::getModalQuery(Drug::className());
            $dayQuery   = self::getModalDayQuery(Drug::className());

            $return = [
                'day'   => Drug::find()->where(['id' => $dayQuery])->limit($limit)->all(),
                'total' => Drug::find()->where(['id' => $totalQuery])->limit($limit)->all(),
            ];

            Yii::$app->cache->set(self::CACHE_POPULAR_DRUGS_KEY, $return, self::CACHE_POPULAR_DRUGS_DURATION);
        }

        return $return;
    }

    public static function getPopularPharmacies($limit)
    {
        $return = Yii::$app->cache->get(self::CACHE_POPULAR_PHARMACIES_KEY);

        if ($return === false) {
            $totalQuery = self::getModalQuery(Pharmacie::className());
            $dayQuery   = self::getModalDayQuery(Pharmacie::className());

            $return = [
                'day'   => Pharmacie::find()->where(['id' => $dayQuery])->limit($limit)->all(),
                'total' => Pharmacie::find()->where(['id' => $totalQuery])->limit($limit)->all(),
            ];

            Yii::$app->cache->set(self::CACHE_POPULAR_PHARMACIES_KEY, $return, self::CACHE_POPULAR_PHARMACIES_DURATION);
        }

        return $return;
    }

    public static function getModalByLast24($model_name, $model_id)
    {
        $beginOfDay = strtotime("midnight", time());
        $endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;

        $model = self::find()
            ->where([
                'model_name' => self::getModelClass($model_name),
                'model_id'   => $model_id
            ])
            ->andWhere('created_at > :begin', [':begin' => $beginOfDay])
            ->andWhere('created_at < :end',   [':end'   => $endOfDay])
            ->one();

        if(!$model) {
            $model = new self(['model_name' => $model_name, 'model_id' => $model_id]);
        }

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('statistic', 'ID'),
            'model_name' => Yii::t('statistic', 'MODEL_NAME'),
            'model_id'   => Yii::t('statistic', 'MODEL_ID'),
            'unique'     => Yii::t('statistic', 'UNIQUE'),
            'non_unique' => Yii::t('statistic', 'NON_UNIQUE'),
            'created_at' => Yii::t('statistic', 'CREATED_AT'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $this->model_name = self::getModelClass($this->model_name);

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $extend = new StatisticExtend([
            'user_id' => Yii::$app->user->id,
            'ip'      => Yii::$app->request->getUserIP()
        ]);

        $this->link('extended', $extend);
    }

    protected static function getModalDayQuery($className = null)
    {
        return self::getModalQuery($className)
            ->andWhere('created_at > :created_at', [':created_at' => time() - 24 * 60 * 60]);
    }

    protected static function getModalQuery($className = null)
    {
        $return = (new Query)
            ->select('id')
            ->from(self::tablename())
            ->orderBy('unique');

        if($className) {
            $return->where('model_name = :model_name', [':model_name' => self::getModelClass($className)]);
        }

        return $return;
    }

    protected static function getModelClass($modelName)
    {
        return StringHelper::basename($modelName);
    }
}
