<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\form\PostForm;
use app\models\search\PostsSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PostController extends Controller {

    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => 'http://yii2test.ru/uploads/', // Directory URL address, where files are stored.
                'path' => '/home/srv99999/yii2test.ru/web/uploads/' // Or absolute path to directory where files are stored.
            ],
        ];
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $dir = Yii::getAlias('@app/public_html/images');

            $file = UploadedFile::getInstance($model, 'file');
            $file->saveAs($dir . '/' .'post_file['.time().']'  );

            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new PostForm();
        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {

            $dir = Yii::getAlias('@app/public_html/images');

            $file = UploadedFile::getInstance($model, 'file');
            $file->saveAs($dir . '/' .'post_file['.time().']'  );

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                 'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = PostForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}