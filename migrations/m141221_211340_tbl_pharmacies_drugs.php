<?php

use app\models\Drug;
use app\models\Pharmacie;
use yii\db\Schema;
use yii\db\Migration;

class m141221_211340_tbl_pharmacies_drugs extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%pharmacies_drugs}}',
            [
                'pharmacie_id'  => Schema::TYPE_INTEGER,
                'drug_id'       => Schema::TYPE_INTEGER,
                'created_at'    => Schema::TYPE_INTEGER,
            ],
            'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB'
        );

        $this->addPrimaryKey('pharmacies_drugs', "{{%pharmacies_drugs}}", 'pharmacie_id,drug_id');


        $this->addForeignKey(
            'FK_pharmacies_drugs_pharmacie_id',
            '{{%pharmacies_drugs}}', 'pharmacie_id',
            Pharmacie::tableName(),  'id',
            'CASCADE',  'CASCADE'
        );
        $this->addForeignKey(
            'FK_pharmacies_drugs_drug_id',
            '{{%pharmacies_drugs}}', 'drug_id',
            Drug::tableName(),       'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%pharmacies_drugs}}');
    }
}