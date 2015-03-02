<?php

namespace app\modules\api\v1\controllers;

use app\models\Pharmacie;
use app\modules\api\v1\components\ActiveController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class DistrictsController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\District';

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

        if((int)$cityId = Yii::$app->request->get('cityId')) {
            $query->where('city_id = :city_id', [':city_id' => $cityId]);
        }

        if($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

        $query->join('INNER JOIN', Pharmacie::tableName(), "`map_districts`.`id` = `pharmacies`.`district_id`")
            ->groupBy('`pharmacies`.`district_id`');

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}