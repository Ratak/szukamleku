<?php

namespace app\controllers\admin;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Banners;
use app\models\search\BannersSearch;

class BannersController extends IndexController
{

    public function actionIndex()
    {
        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actionCreate()
    {
        $model = new Banners();
        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {

            $dir = Yii::getAlias('@app/public_html/images');

            $file = UploadedFile::getInstance($model, 'image');
            $file_name = md5(time()). '.' . $file->extension;
            if($file->saveAs($dir . '/' . $file_name  )) {
                $model->image = Yii::getAlias('@web').'/images/'.$file_name;
            }

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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $dir = Yii::getAlias('@app/public_html/images');

            $file = UploadedFile::getInstance($model, 'image');
            $file_name = md5(time()). '.' . $file->extension;
            if($file->saveAs($dir . '/' . $file_name  )) {
                $model->image = Yii::getAlias('@web').'/images/'.$file_name;
            }

            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                    'model' => $model,
                ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}