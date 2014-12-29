<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

namespace app\controllers;

use app\models\form\LoginForm;
use app\models\form\RecoverForm;
use app\models\form\SignupForm;
use app\models\Language;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['login', 'signup', 'recover', 'recover-confirmation'],
                        'roles'   => ['?']
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['logout'],
                        'roles'   => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('signup', Yii::t('auth', 'FLASH_SUCCESS_SIGNUP'));

            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Language::setCurrent(Yii::$app->user->identity->language);

            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return Yii::$app->response->redirect(['']);
    }

    public function actionRecover()
    {
        $model = new RecoverForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->recover()) {
            return Yii::$app->response->redirect(['/auth/login']);
        }

        return $this->render('recover', [
            'model' => $model
        ]);
    }

    public function actionRecoverConfirmation()
    {
        return $this->render('recover-confirmation');
    }
}