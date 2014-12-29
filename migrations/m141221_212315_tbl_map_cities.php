<?php

use app\models\City;
use app\models\Region;
use yii\db\Schema;
use yii\db\Migration;

class m141221_212315_tbl_map_cities extends Migration
{
    public function up()
    {
        $this->createTable(City::tableName(), [
            'id'        => Schema::TYPE_PK,
            'name'      => Schema::TYPE_STRING . '(150)',
            'region_id' => Schema::TYPE_INTEGER,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('region_id', City::tableName(), 'region_id');

        $this->addForeignKey(
            'FK_cities_region_id',
            City::tableName(),   'region_id',
            Region::tableName(), 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(City::tableName());
    }
}
