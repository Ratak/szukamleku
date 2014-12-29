<?php

use app\models\City;
use app\models\District;
use yii\db\Schema;
use yii\db\Migration;

class m141221_213419_tbl_map_districts extends Migration
{
    public function up()
    {
        $this->createTable(District::tableName(), [
            'id'      => Schema::TYPE_PK,
            'name'    => Schema::TYPE_STRING . '(150)',
            'city_id' => Schema::TYPE_INTEGER,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('city_id', District::tableName(), 'city_id');

        $this->addForeignKey(
            'FK_district_city_id',
            District::tableName(), 'city_id',
            City::tableName(),     'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(District::tableName());
    }
}
