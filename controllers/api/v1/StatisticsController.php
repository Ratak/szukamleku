<?php

namespace app\controllers\api\v1;

use app\models\Statistic;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class StatisticsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];

        return $behaviors;
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
