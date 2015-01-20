<?php

use app\models\Statistic;
use yii\db\Schema;
use yii\db\Migration;

class m150112_014844_tbl_statistics extends Migration
{
    public function up()
    {
        $this->createTable(Statistic::tableName(), [
            'id'         => Schema::TYPE_PK,
            'model_name' => Schema::TYPE_STRING,
            'model_id'   => Schema::TYPE_INTEGER . ' UNSIGNED',
            'unique'     => Schema::TYPE_INTEGER . ' UNSIGNED DEFAULT "1"',
            'non_unique' => Schema::TYPE_INTEGER . ' UNSIGNED DEFAULT "1"',
            'created_at' => Schema::TYPE_INTEGER . ' UNSIGNED',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex('model_date', Statistic::tableName(), 'model_name,model_id,created_at', true);
    }

    public function down()
    {
        $this->dropTable(Statistic::tableName());
    }
}
