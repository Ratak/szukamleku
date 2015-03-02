<?php
/**
 * @link      http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license   http://www.astwellsoft.com/license/
 */

namespace app\models\form;

use app\models\Profile;
use app\models\User;
use Yii;
use yii\base\Event;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $repassword;
    public $company;
    public $first_name;
    public $last_name;
    public $phone;
    public $fax;
    public $legal_address;
    public $postal_address;
    public $krs;
    public $acept_legal;


    /**
     * @var User
     */
    protected $user;

    /** @inheritdoc */
    public function init()
    {
        parent::init();

        Event::on(User::className(), User::EVENT_AFTER_INSERT, [$this, 'send']);
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'          => Yii::t('auth', 'EMAIL'),
            'password'       => Yii::t('auth', 'PASSWORD'),
            'repassword'     => Yii::t('auth', 'REPASSWORD'),
            'company'        => Yii::t('auth', 'COMPANY'),
            'first_name'     => Yii::t('auth', 'FIRST_NAME'),
            'last_name'      => Yii::t('auth', 'LAST_NAME'),
            'phone'          => Yii::t('auth', 'PHONE'),
            'fax'            => Yii::t('auth', 'FAX'),
            'legal_address'  => Yii::t('auth', 'LEGAL_ADDRESS'),
            'postal_address' => Yii::t('auth', 'POSTAL_ADDRESS'),
            'krs'            => Yii::t('auth', 'KRS'),
            'acept_legal'    => Yii::t('auth', 'ACEPT_LEGAL'),
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'signup-form';
    }

    /**
     * Registers a new user account.
     *
     * @return bool
     */
    public function signup()
    {
        $attr = Yii::$app->request->post();

        $this->user = new User(['scenario' => 'signup']);
        $profile = new Profile(['scenario' => 'signup']);

        $this->user->setAttributes($attr);
        $profile->setAttributes($attr);

        if ($this->user->validate() && $profile->validate()) {
            $this->user->setProfile($profile);

            $this->user->generateAuthKey();
            $this->user->generateAccessToken();

            if ($this->user->save(false)) {
                Yii::info('User has been registered');

                return true;
            }
        }

        $this->addErrors($this->user->getErrors());
        $this->addErrors($profile->getErrors());

        return false;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Send an email.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
        return Yii::$app->mailer
            ->compose('signup', ['model' => $this->user])
            ->setTo($this->user->email)
            ->setSubject(Yii::t('auth', 'EMAIL_SUBJECT_SIGNUP'))
            ->send();
    }
}