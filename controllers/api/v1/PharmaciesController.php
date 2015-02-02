<?php

namespace app\controllers\api\v1;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class PharmaciesController extends AbstractRestController
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

        if($region_id = Yii::$app->request->get('region_id')) {
            $query->where('region_id = :region_id', [':region_id' => $region_id]);
        }

        if($city_id = Yii::$app->request->get('city_id')) {
            $query->where('city_id = :city_id', [':city_id' => $city_id]);
        }

        if($district_id = Yii::$app->request->get('district_id')) {
            $query->where('district_id = :district_id', [':district_id' => $district_id]);
        }

        if($coordinate = Yii::$app->request->get('coordinate') && isset($coordinate[0]) && isset($coordinate[1])) {
            $query->where('latitude = :latitude', [':latitude' => $coordinate[0]]);
            $query->where('longitude = :longitude', [':longitude' => $coordinate[1]]);
        }

        if($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

//        $query->join('LEFT OUTER JOIN', PharmaciesDrugs::tableName(), '`pharmacies`.`id` = `pharmacies_drugs`.`pharmacie_id`')
//            ->andWhere('`pharmacies_drugs`.`pharmacie_id` IS not NULL');

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
