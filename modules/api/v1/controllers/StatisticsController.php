<?php

namespace app\modules\api\v1\controllers;

use app\models\Statistic;
use app\modules\api\v1\components\Controller;
use Yii;

class StatisticsController extends Controller
{
    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index'              => ['GET'],
            'popular-drugs'      => ['GET'],
            'popular-pharmacies' => ['GET'],
        ];
    }

    public function actionIndex()
    {
        return Statistic::getTotal();
    }

    public function actionPopularDrugs($limit = 10)
    {
        return Statistic::getPopularDrugs($limit);
    }

    public function actionPopularPharmacies($limit = 10)
    {
        return Statistic::getPopularDrugs($limit);
    }
}
