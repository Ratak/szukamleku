<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;

class NewslettersController extends Controller {

    public function actionIndex()
    {
        return $this->render('index');
    }
}