<?php

use app\models\Region;
use yii\db\Schema;
use yii\db\Migration;

class m141221_212148_tbl_map_regions extends Migration
{
    public function up()
    {
        $this->createTable(Region::tableName(), [
            'id'          => Schema::TYPE_PK,
            'name'        => Schema::TYPE_STRING . '(150)',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable(Region::tableName());
    }
}
