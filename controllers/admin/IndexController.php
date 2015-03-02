<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 05.02.15
 * Time: 20:48
 */

namespace app\controllers\admin;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class IndexController extends Controller
{
    public $layout = 'admin';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

    }
}