<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\components;

use app\models\Statistic;
use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\web\Controller;

class StatisticBehavior extends Behavior
{
    public $actions = [];

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [Controller::EVENT_AFTER_ACTION => 'addStatistic'];
    }

    /**
     * @param ActionEvent $event
     *
     * @return bool Always true
     */
    public function addStatistic(ActionEvent $event)
    {
        $action = $event->action->id;

        if (in_array($action, $this->actions) || in_array('*', $this->actions)) {
            $model = get_class($event->result);
            $id = $event->result->getPrimaryKey();

            $stat = Statistic::getModalByLast24($model, $id);

            if( ! $stat->save()) {
                Yii::error('Statistic save error');
            }
        }

        return true;
    }
}