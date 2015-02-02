<?php

namespace app\controllers\api\v1;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class DrugsController extends AbstractRestController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Drug';

//    public $serializer = [
//        'class' => 'yii\rest\Serializer',
//        'collectionEnvelope' => 'items',
//    ];

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function actionGetFirsLetters()
    {
        /* @var $modelClass \app\models\Drug */
        $modelClass = $this->modelClass;

        return $modelClass::getFirstLetters();
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

        if($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
