<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\components\AuthController;
use Yii;
use yii\web\ForbiddenHttpException;

class UserController extends AuthController
{
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException;
        }

        return Yii::$app->user->getIdentity();
    }


    public function actionPharmacies()
    {

    }
}