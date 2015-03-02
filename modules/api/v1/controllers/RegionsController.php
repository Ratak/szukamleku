<?php

namespace app\modules\api\v1\controllers;


use app\modules\api\v1\components\ActiveController;

class RegionsController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Region';
}