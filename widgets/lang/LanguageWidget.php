<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\widgets\lang;

use app\models\Language;
use yii\bootstrap\Widget;

class LanguageWidget extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('widget', [
            'current' => Language::getCurrent(),
            'langs'   => Language::getAllArray(true),
        ]);
    }
}