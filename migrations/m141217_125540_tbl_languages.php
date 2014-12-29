<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

use app\models\Language;
use yii\db\Schema;
use yii\db\Migration;

class m141217_125540_tbl_languages extends Migration
{
    public function up()
    {
        $this->createTable(Language::tableName(), [
            'id'          => Schema::TYPE_PK,
            'url'         => Schema::TYPE_STRING  . '(2)',
            'local'       => Schema::TYPE_STRING  . '(5)',
            'name'        => Schema::TYPE_STRING  . '(30)',
            'default'     => Schema::TYPE_BOOLEAN . ' DEFAULT 0'
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('default', Language::tableName(), 'default');
    }

    public function down()
    {
        $this->dropTable(Language::tableName());
    }
}
