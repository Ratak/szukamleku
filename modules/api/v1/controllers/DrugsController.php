<?php

namespace app\modules\api\v1\controllers;

use app\models\PharmaciesDrugs;
use app\modules\api\v1\components\ActiveControllerStatistic;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class DrugsController extends ActiveControllerStatistic
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Drug';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['get-firs-letters'] = ['GET'];

        return $verbs;
    }

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

        if ((int)$pharmacyId = Yii::$app->request->get('pharmacyId')) {
            $query->join('LEFT OUTER JOIN', ['pd' => PharmaciesDrugs::tableName()], '`id` = `pd`.`drug_id`')
                ->where(['`pd`.`pharmacie_id`' => $pharmacyId]);
        }

        if ($first_letters = Yii::$app->request->get('first_letters')) {
            $query->andFilterWhere(['like', 'name', $first_letters . '%', false]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
