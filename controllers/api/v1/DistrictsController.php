<?php

namespace app\controllers\api\v1;

use Yii;
use yii\data\ActiveDataProvider;

class DistrictsController extends AbstractRestController
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
     * Prepares the data provider that should return the requested collection of the models.
     *
     * @param \yii\rest\Action $action
     *
     * @return ActiveDataProvider
     */
    public static function prepareDataProvider(\yii\rest\Action $action)
    {
        /* @var $modelClass \app\models\City */
        $modelClass = $action->modelClass;

        $query = ( null !== $city_id = Yii::$app->request->get('city_id'))
            ? $modelClass::find()->where('city_id = :city_id', [':city_id' => $city_id])
            : $modelClass::find();

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
