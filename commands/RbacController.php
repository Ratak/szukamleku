<?php
/**
 * Created by PhpStorm.
 * User: lemb
 * Date: 06.02.15
 * Time: 0:35
 */

namespace app\commands;

use app\rbac\RoleRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        // Add permissions in Yii::$app->authManager
        $auth->add($signup = $auth->createPermission('signup'));
        $auth->add($login  = $auth->createPermission('login'));
        $auth->add($logout = $auth->createPermission('logout'));
        $auth->add($error  = $auth->createPermission('error'));
        $auth->add($index  = $auth->createPermission('index'));
        $auth->add($view   = $auth->createPermission('view'));
        $auth->add($update = $auth->createPermission('update'));
        $auth->add($delete = $auth->createPermission('delete'));

        // Create roles
        $auth->add($guest   = $auth->createRole('guest'));
        $auth->add($manager = $auth->createRole('manager'));
        $auth->add($admin   = $auth->createRole('admin'));

        // Add rule, based on UserExt->group === $user->group
        $auth->add($userRoleRule = new RoleRule());

        // Add rule "userRoleRule" in roles
        $guest->ruleName   = $userRoleRule->name;
        $manager->ruleName = $userRoleRule->name;
        $admin->ruleName   = $userRoleRule->name;

        // Guest
        $auth->addChild($guest, $login);
        $auth->addChild($guest, $logout);
        $auth->addChild($guest, $error);
        $auth->addChild($guest, $signup);
        $auth->addChild($guest, $index);
        $auth->addChild($guest, $view);

        // Manager
        $auth->addChild($manager, $update);
        $auth->addChild($manager, $guest);

        // Admin
        $auth->addChild($admin, $delete);
        $auth->addChild($admin, $manager);
    }
}