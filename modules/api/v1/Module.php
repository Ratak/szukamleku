<?php

namespace app\modules\api\v1;

use app\modules\api\Module as BaseModuleAPI;

class Module extends BaseModuleAPI
{
    public $controllerNamespace = 'app\modules\api\v1\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
