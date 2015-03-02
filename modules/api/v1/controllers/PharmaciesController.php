<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\components\ActiveControllerStatistic;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class PharmaciesController extends ActiveControllerStatistic
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Pharmacie';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    /**
     * @param Action $action
     *
     * @return ActiveDataProvider
     */
    public static function prepareDataProvider(Action $action)
    {
        /* @var $modelClass \app\models\City */
        $modelClass = $action->modelClass;

        $query = $modelClass::find();

        if ((int)$cityId = Yii::$app->request->get('cityId')) {
            $query->where('city_id = :cityId', [':cityId' => $cityId]);
        }

        if ((int)$districtId = Yii::$app->request->get('districtId')) {
            $query->where('district_id = :districtId', [':districtId' => $districtId]);
        }

        if ($coordinate = Yii::$app->request->get('coordinate') && isset($coordinate[0]) && isset($coordinate[1])) {
            $query->where('latitude = :latitude', [':latitude' => $coordinate[0]]);
            $query->where('longitude = :longitude', [':longitude' => $coordinate[1]]);
        }

        if ($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
