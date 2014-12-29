<?php

use app\models\Region;
use yii\db\Migration;

class m241221_212158_insert_map_regions extends Migration
{
    public function up()
    {
        $this->batchInsert(Region::tableName(), ['id', 'name'], [
            [1, 'Dolnośląskie'],
            [2, 'Kujawsko-Pomorskie'],
            [3, 'Lubelskie'],
            [4, 'Lubuskie'],
            [5, 'Mazowieckie'],
            [6, 'Małopolskie'],
            [7, 'Opolskie'],
            [8, 'Podkarpackie'],
            [9, 'Podlaskie'],
            [10, 'Pomorskie'],
            [11, 'Śląskie'],
            [12, 'Świętokrzyskie'],
            [13, 'Warmińsko-Mazurskie'],
            [14, 'Wielkopolskie'],
            [15, 'Zachodniopomorskie'],
            [16, 'Łódzkie'],
        ]);
    }

    public function down()
    {
    }
}
