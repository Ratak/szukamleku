<?php

use app\models\Drug;
use yii\db\Schema;
use yii\db\Migration;

class m141221_203258_tbl_drugs extends Migration
{
    public function up()
    {
        $this->createTable(Drug::tableName(), [
            'id'                  => Schema::TYPE_PK,
            'name'                => Schema::TYPE_STRING,
            'name_international'  => Schema::TYPE_STRING,
            'name_pharmaceutical' => Schema::TYPE_STRING,
            'chemical_components' => Schema::TYPE_STRING,
            'release_form'        => Schema::TYPE_STRING,
            'dosage'              => Schema::TYPE_STRING,
            'quantity_in_package' => Schema::TYPE_STRING,
            'manufacturer'        => Schema::TYPE_STRING,
            'status_id'           => Schema::TYPE_SMALLINT . '(1) UNSIGNED',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable(Drug::tableName());
    }
}
