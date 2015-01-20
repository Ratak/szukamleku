<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\controllers\api\v1;

use app\models\form\SignupForm;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];

        return $behaviors;
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        $model->load(Yii::$app->request->post());

        if( $model->signup() ) {
            return $model;
        }

        Yii::$app->response->setStatusCode( 400 );

        return $model->getErrors();
    }
}