<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

namespace app\modules\api\v1\controllers;

use app\models\form\LoginForm;
use app\models\form\SignupForm;
use app\models\Language;
use app\modules\api\v1\components\Controller;
use Yii;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'signup' => ['POST'],
            'login'  => ['POST'],
            'logout' => ['GET'],
        ];
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $model->load(Yii::$app->request->post(), false);

        if ($model->signup()) {
            return $model->getUser();
        }

        Yii::$app->response->setStatusCode(400);

        return $model->getErrors();
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->post(), '');

        if ($model->login()) {
            Language::setCurrent(Yii::$app->user->identity->language);

            return Yii::$app->user->identity->access_token;
        }

        return $model->getErrors();
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
    }
}