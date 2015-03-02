<?php

use yii\db\Schema;
use yii\db\Migration;

class m141230_114115_tpl_pages_lang extends Migration
{
    public function up()
    {
        $this->createTable('{{%pages_lang}}', [
                'id'           => Schema::TYPE_PK,
                'post_id'  => Schema::TYPE_INTEGER,
                'language_id'  => Schema::TYPE_INTEGER,
                'name'         => Schema::TYPE_STRING   . ' NOT NULL',
                'content'      => Schema::TYPE_TEXT     . ' NOT NULL',
                'meta_keys'    => Schema::TYPE_STRING   . ' NOT NULL',
                'meta_desc'    => Schema::TYPE_STRING   . ' NOT NULL',
                'meta_title'   => Schema::TYPE_STRING   . ' NOT NULL',
            ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );
    }

    public function down()
    {
        $this->dropTable('{{%pages_lang}}');
    }
}
