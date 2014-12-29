<?php

namespace app\controllers\api\v1;

use Yii;
use yii\data\ActiveDataProvider;

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

        $query = ( null !== $region_id = Yii::$app->request->get('region_id'))
            ? $modelClass::find()->where('region_id = :region_id', [':region_id' => $region_id])
            : $modelClass::find();

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
