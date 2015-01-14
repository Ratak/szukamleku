<?php

use app\models\User;
use app\models\Language;
use yii\db\Schema;
use yii\db\Migration;

class m141230_114104_tpl_pages extends Migration
{
    public function up()
    {
        $this->createTable('{{%pages}}', [
                'id'           => Schema::TYPE_PK,
                'language_id'  => Schema::TYPE_INTEGER,
                'user_id'      => Schema::TYPE_INTEGER,
                'updated_at'   => Schema::TYPE_INTEGER  . ' NULL',
                'created_at'   => Schema::TYPE_INTEGER  . ' NULL',
                'file'         => Schema::TYPE_STRING   . ' NULL',
            ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        $this->addForeignKey(
            'FK_pages_user',
            '{{%pages}}',      'user_id',
            User::tableName(), 'id',
            'CASCADE', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_language_id',
            '{{%pages}}',      'language_id',
            Language::tableName(), 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
