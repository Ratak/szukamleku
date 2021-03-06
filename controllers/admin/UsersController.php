<?php

namespace app\controllers\admin;

use app\models\Profile;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use yii\web\NotFoundHttpException;

class UsersController extends IndexController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionExpandRow()
    {
        return $this->renderPartial('_expand-row', [
            'model' => $this->findModel(Yii::$app->request->post('expandRowKey')),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();

        $model    = new User(['scenario' => 'create']);
        $profile = new Profile(['scenario' => 'create']);

        if (($model->load($post) && $profile->load($post)) && ($model->validate() && $profile->validate())) {
            $model->setProfile($profile);

            if($model->save(false)) {
                Yii::$app->session->setFlash( Yii::t('user', 'FLAH_USER_CREATE_SUCCESS') );
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                Yii::$app->session->setFlash( Yii::t('user', 'FLAH_USER_CREATE_ERROR') );
            }
        }

        return $this->render('create', [
            'model'   => $model,
            'profile' => $profile,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = Yii::$app->request->post();

        $model = $this->findModel($id);
        $model->setScenario('update');

        $profile = $model->profile;
        $profile->setScenario('update');

        if (($model->load($post) && $profile->load($post)) && ($model->validate() && $profile->validate())) {
            if($model->save(false)) {
                Yii::$app->session->setFlash( Yii::t('user', 'FLAH_USER_UPDATE_SUCCESS') );
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                Yii::$app->session->setFlash( Yii::t('user', 'FLAH_USER_UPDATE_ERROR') );
            }
        }

        return $this->render('update', [
            'model'   => $model,
            'profile' => $profile,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        else {
            throw new NotFoundHttpException( Yii::t('user', 'REQUESTED_USER_DOES_NOT_EXIST'));
        }
    }
}
