<?php

use app\models\Statistic;
use app\models\StatisticExtend;
use yii\db\Schema;
use yii\db\Migration;

class m150112_015806_tbl_statistics_extend extends Migration
{
    public function up()
    {
        $this->createTable(StatisticExtend::tableName(), [
            'id'           => Schema::TYPE_PK,
            'statistic_id' => Schema::TYPE_INTEGER,
            'user_id'      => Schema::TYPE_INTEGER . ' UNSIGNED DEFAULT NULL',
            'ip'           => Schema::TYPE_STRING . '(15)',
            'created_at'   => Schema::TYPE_INTEGER . ' UNSIGNED',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

//        $this->createIndex('statistic_id', StatisticExtend::tableName(), 'statistic_id');

        $this->addForeignKey(
            'FK_statistics_extend_statistics',
            StatisticExtend::tableName(), 'statistic_id',
            Statistic::tableName(),       'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(StatisticExtend::tableName());
    }
}
