<?php

namespace app\modules\api\v1\controllers;

use app\models\Pharmacie;
use app\modules\api\v1\components\ActiveController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class CitiesController extends ActiveController
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

        $query->join('INNER JOIN', ['p' => Pharmacie::tableName()], "`map_cities`.`id` = `p`.`city_id`")
            ->groupBy('`p`.`city_id`');

        if ((int)$regionId = Yii::$app->request->get('regionId')) {
            $query->where(['`map_cities`.region_id' => $regionId]);
        }

        if ($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', '`map_cities`.`name`', $first_letters . '%', false]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
