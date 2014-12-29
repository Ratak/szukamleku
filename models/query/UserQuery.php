<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\models\query;

use app\models\User;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    /**
     * Выбираем активных
     */
    public function active()
    {
        return $this->andWhere('status_id = :status', [':status' => User::STATUS_ACTIVE]);
    }

    /**
     * Выбираем блокированных
     */
    public function banned()
    {
        return $this->andWhere('status_id = :status', [':status' => User::STATUS_BANNED]);
    }

    /**
     * Выбираем администраторов
     */
    public function admin()
    {
        return $this->andWhere('role_id = :role', [':role' => User::ROLE_ADMIN]);
    }

    /**
     * Выбираем менеджеров (пользователей)
     */
    public function manager()
    {
        return $this->andWhere('role_id = :role', [':role' => User::ROLE_MANAGER]);
    }
}