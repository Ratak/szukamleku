<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Newsletters;
use app\models\search\NewslettersSearch;

class NewslettersController extends Controller {

    public function actionIndex()
    {
        $searchModel = new NewslettersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actionCreate()
    {
        $model = new Newsletters();
        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                    'model' => $model,
                ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => $users
            ]);
        }
    }

    public function actionSend($id) {

        $model = $this->findModel($id);

        return $this->render('send', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Newsletters::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}