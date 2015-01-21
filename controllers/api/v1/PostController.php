<?php

namespace app\controllers\api\v1;

use Yii;

class PostController extends AbstractRestController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\form\PostForm';
}
