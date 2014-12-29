<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\models\form;

use app\models\Token;
use app\models\User;
use Yii;
use yii\base\Event;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class RecoverForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var User|bool
     */
    private $_user = false;

    /** @inheritdoc */
    public function init()
    {
        parent::init();

        Event::on(Token::className(), Token::EVENT_AFTER_UPDATE, [$this, 'send']);
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => User::className(), 'message' => Yii::t('auth', 'NO_USER_WITH_SUCH_EMAIL')],
            ['email', 'compare', 'compareValue' => User::STATUS_INACTIVE, 'operator' => '!='],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('auth', 'EMAIL'),
        ];
    }

    /**
     * Sends recovery message.
     *
     * @return bool
     */
    public function recover()
    {
        if ($this->validate()) {
            $token = new Token([
                'user_id' => User::findByEmail($this->email)->id,
                'type'    => Token::TYPE_RECOVER
            ]);

            $token->save(false);

            Yii::$app->session->setFlash('FLAH_RECOVERY_SENT');

            return true;
        }

        return false;
    }

    /**
     * Send an email.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
        return Yii::$app->mailer
            ->compose('recover', ['model' => $this])
            ->setTo($this->email)
            ->setSubject(Yii::t('auth', 'EMAIL_SUBJECT_RECOVER'))
            ->send();
    }
}
