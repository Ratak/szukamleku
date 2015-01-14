<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Banners;

class BannersController extends Controller {

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $model = new Banners();
        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                    'model' => $model,
                ]);
        }
    }
}