<?php

namespace app\modules\api;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;

        $this->modules = [
            'v1' => 'app\modules\api\v1\Module',
        ];
    }
}
