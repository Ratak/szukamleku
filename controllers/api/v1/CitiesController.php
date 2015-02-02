<?php

namespace app\controllers\api\v1;

use app\models\Pharmacie;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class CitiesController extends AbstractRestController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\City';

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

        if($region_id = Yii::$app->request->get('region_id')) {
            $query->where('`map_cities`.`region_id` = :region_id', [':region_id' => $region_id]);
        }

        if($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

        $query->join('INNER JOIN', Pharmacie::tableName(), "`map_cities`.`id` = `pharmacies`.`city_id`")
            ->groupBy('`pharmacies`.`city_id`');

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
