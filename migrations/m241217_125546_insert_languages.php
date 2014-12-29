<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

use app\models\Language;
use yii\db\Migration;

class m241217_125546_insert_languages extends Migration
{
    public function up()
    {
        $this->batchInsert(Language::tableName(), ['url', 'local', 'name', 'default'], [
            ['pl', 'pl-PL', 'Polski',  1],
            ['en', 'en-US', 'English', 0],
            ['ru', 'ru-RU', 'Русский', 0],
        ]);
    }

    public function down()
    {
    }
}
