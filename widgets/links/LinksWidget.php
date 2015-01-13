<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\widgets\links;

use app\models\Links;
use yii\bootstrap\Widget;

class LinksWidget extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('widget', [
                'links' => Links::find()->all(),
            ]);
    }
}