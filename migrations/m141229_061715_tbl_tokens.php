<?php

use yii\db\Schema;
use yii\db\Migration;

class m141229_061715_tbl_tokens extends Migration
{
    public function up()
    {
        $this->createTable('{{%tokens}}', [
            'user_id'    => Schema::TYPE_INTEGER  . '     NOT NULL',
            'type'       => Schema::TYPE_SMALLINT . '     NOT NULL',
            'code'       => Schema::TYPE_STRING   . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER  . '     NOT NULL',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('token_unique', '{{%tokens}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk_user_token', '{{%tokens}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%tokens}}');
    }
}
