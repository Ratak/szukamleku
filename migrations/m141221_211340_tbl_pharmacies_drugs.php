<?php

use app\models\Drug;
use app\models\Pharmacie;
use app\models\PharmaciesDrugs;
use yii\db\Schema;
use yii\db\Migration;

class m141221_211340_tbl_pharmacies_drugs extends Migration
{
    public function up()
    {
        $this->createTable(PharmaciesDrugs::tableName(), [
            'pharmacie_id'  => Schema::TYPE_INTEGER,
            'drug_id'       => Schema::TYPE_INTEGER,
            'price'         => Schema::TYPE_DECIMAL . '(8,2)',
            'quantity'      => Schema::TYPE_INTEGER,
            'sync_at'       => Schema::TYPE_INTEGER,
            'created_at'    => Schema::TYPE_INTEGER,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addPrimaryKey('pharmacies_drugs', PharmaciesDrugs::tableName(), 'pharmacie_id,drug_id');

        $this->addForeignKey(
            'FK_pharmacies_drugs_pharmacie_id',
            PharmaciesDrugs::tableName(), 'pharmacie_id',
            Pharmacie::tableName(),       'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_pharmacies_drugs_drug_id',
            PharmaciesDrugs::tableName(), 'drug_id',
            Drug::tableName(),            'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable(PharmaciesDrugs::tableName());
    }
}