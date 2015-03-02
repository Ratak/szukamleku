<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 08.02.15
 * Time: 0:01
 */

namespace app\modules\api\v1\components;


use yii\filters\auth\QueryParamAuth;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];

        return $behaviors;
    }
}