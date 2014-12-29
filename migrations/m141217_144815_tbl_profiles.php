<?php

use app\models\Profile;
use app\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m141217_144815_tbl_profiles extends Migration
{
    public function up()
    {
        $this->createTable(Profile::tableName(), [
            'user_id'        => Schema::TYPE_PK,
            'company'        => Schema::TYPE_STRING,
            'first_name'     => Schema::TYPE_STRING,
            'last_name'      => Schema::TYPE_STRING,
            'phone'          => Schema::TYPE_STRING,
            'fax'            => Schema::TYPE_STRING,
            'legal_address'  => Schema::TYPE_STRING,
            'postal_address' => Schema::TYPE_STRING,
            'krs'            => Schema::TYPE_STRING,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'FK_profile_user',
            Profile::tableName(), 'user_id',
            User::tableName(),    'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(Profile::tableName());
    }
}
