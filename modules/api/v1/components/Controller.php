<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 07.02.15
 * Time: 11:41
 */

namespace app\modules\api\v1\components;

use yii\rest\Controller as YiiController;
use yii\web\Response;

class Controller extends YiiController
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
}