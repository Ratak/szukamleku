<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;
use app\models\form\ContactForm;
use app\models\form\NewsletterForm;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPosts()
    {
        return $this->render('posts');
    }

    public function actionNewsletters()
    {
        $model = new NewsletterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->isNewRecord) {
            $model->save();
            Yii::$app->session->setFlash('userSubscribe');
        }
        elseif($model->load(Yii::$app->request->post()) && $model->validate() && !$model->isNewRecord) {
            $model->delete();
            Yii::$app->session->setFlash('userUnsubscribe');
        }
        return $this->render('newsletters',[
            'model' => $model
        ]);
    }
}