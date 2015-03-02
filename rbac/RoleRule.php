<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 06.02.15
 * Time: 0:45
 */

namespace app\rbac;

use app\models\User;
use Yii;
use yii\rbac\Rule;

class RoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role_id;

            switch ($item->name) {
                case 'admin':
                    return $role === User::ROLE_ADMIN;
                case 'manager':
                    return $role === User::ROLE_MANAGER;
            }
        }

        return false;
    }
}