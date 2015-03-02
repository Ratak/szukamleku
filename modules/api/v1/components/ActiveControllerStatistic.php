<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

namespace app\modules\api\v1\components;

use app\components\StatisticBehavior;

class ActiveControllerStatistic extends ActiveController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['statisticBehavior'] = [
            'class'   => StatisticBehavior::className(),
            'actions' => ['view'],
        ];

        return $behaviors;
    }
}