<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\Language;

class m150109_083901_tbl_links extends Migration
{
    public function up()
    {
        $this->createTable('{{%links}}', [
                'id'           => Schema::TYPE_PK,
                'language_id'  => Schema::TYPE_INTEGER,
                'name'         => Schema::TYPE_STRING   . ' NOT NULL',
                'link'         => Schema::TYPE_TEXT     . ' NOT NULL',
                'created_at'   => Schema::TYPE_INTEGER  . ' NULL',
                'updated_at'   => Schema::TYPE_INTEGER  . ' NULL',
            ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        $this->addForeignKey(
            'FK_links_language_id',
            '{{%links}}',      'language_id',
            Language::tableName(), 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%links}}');
    }
}
