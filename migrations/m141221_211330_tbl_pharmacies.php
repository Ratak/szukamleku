<?php

use app\models\Pharmacie;
use app\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m141221_211330_tbl_pharmacies extends Migration
{
    public function up()
    {
        $this->createTable(Pharmacie::tableName(), [
            'id'          => Schema::TYPE_PK,
            'user_id'     => Schema::TYPE_INTEGER,
            'region_id'   => Schema::TYPE_INTEGER,
            'city_id'     => Schema::TYPE_INTEGER . ' NULL',
            'district_id' => Schema::TYPE_INTEGER . ' NULL',
            'code'        => Schema::TYPE_STRING,
            'name'        => Schema::TYPE_STRING,
            'latitude'    => Schema::TYPE_DECIMAL . '(12,9)',
            'longitude'   => Schema::TYPE_DECIMAL . '(12,9)',
            'phone'       => Schema::TYPE_STRING,
            'fax'         => Schema::TYPE_STRING,
            'url'         => Schema::TYPE_STRING,
            'email'       => Schema::TYPE_STRING,
            'address'     => Schema::TYPE_STRING,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'FK_pharmacies_user',
            Pharmacie::tableName(), 'user_id',
            User::tableName(),      'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(Pharmacie::tableName());
    }
}