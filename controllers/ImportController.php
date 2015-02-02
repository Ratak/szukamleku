<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2015 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\controllers;

use app\models\PharmaciesDrugs;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ImportController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionImportCsv()
    {
        $items = Yii::$app->request->post('items');

        foreach(explode("\n", $items) as $item) {
            $item = str_getcsv( $item );

            $data = new PharmaciesDrugs([
                'scenario'      => PharmaciesDrugs::SCENARIO_IMPORT,
                'pharmacieCode' => ArrayHelper::getValue($item, 0),
                'drugName'      => ArrayHelper::getValue($item, 1),
                'manufacturer'  => ArrayHelper::getValue($item, 2),
                'price'         => ArrayHelper::getValue($item, 3),
                'quantity'      => ArrayHelper::getValue($item, 4),
                'date'          => ArrayHelper::getValue($item, 5),
            ]);

            $data->validate();

//            $data->save();
        }

        return 'ok';
    }
}