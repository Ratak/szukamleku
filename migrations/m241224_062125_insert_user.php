<?php

use app\models\User;
use yii\db\Migration;

class m241224_062125_insert_user extends Migration
{
    public $admin_email    = 'admin@domain.com';
    public $admin_password = 'admin@domain.com';

    public function up()
    {
        $time = time();
        $security = Yii::$app->getSecurity();

        $this->insert('{{%users}}', [
            'status_id'     => User::STATUS_ACTIVE,
            'role_id'       => User::ROLE_ADMIN,
            'language'      => 'ru',
            'email'         => $this->admin_email,
            'password_hash' => $security->generatePasswordHash( $this->admin_password ),
            'auth_key'      => $security->generateRandomKey(),
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);

        $this->insert('{{%profiles}}', [
            'user_id' => 1,
        ]);
    }

    public function down()
    {
        $this->delete('{{%users}}', ['email' => $this->admin_email]);
    }
}
