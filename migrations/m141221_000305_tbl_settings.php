<?php

use yii\db\Schema;
use yii\db\Migration;

class m141221_000305_tbl_settings extends Migration
{
    public function up()
    {
        $this->createTable('{{%settings}}', [
            'category' => Schema::TYPE_STRING,
            'key'      => Schema::TYPE_STRING,
            'value'    => Schema::TYPE_TEXT,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addPrimaryKey( 'category_key', "{{%settings}}", 'category,key' );
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
