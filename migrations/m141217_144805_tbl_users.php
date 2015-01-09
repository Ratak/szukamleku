<?php

use app\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m141217_144805_tbl_users extends Migration
{
    public function up()
    {
        $this->createTable(User::tableName(), [
            'id'            => Schema::TYPE_PK,
            'status_id'     => Schema::TYPE_SMALLINT . '(1) DEFAULT ' . User::STATUS_INACTIVE,
            'role_id'       => Schema::TYPE_SMALLINT . '(2) DEFAULT ' . User::ROLE_USER,
            'language'      => Schema::TYPE_STRING   . '(2)',
            'email'         => Schema::TYPE_STRING   . '(100)',
            'company'       => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING,
            'auth_key'      => Schema::TYPE_STRING   . '(32)',
            'created_at'    => Schema::TYPE_INTEGER  . '(11) UNSIGNED',
            'updated_at'    => Schema::TYPE_INTEGER  . '(11) UNSIGNED',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('email',     User::tableName(), 'email', true);
        $this->createIndex('role_id',   User::tableName(), 'role_id');
        $this->createIndex('status_id', User::tableName(), 'status_id');
    }

    public function down()
    {
        $this->dropTable(User::tableName());
    }
}