<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
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

    /** @inheritdoc */
    public function init()
    {
        parent::init();

        Event::on(User::className(), User::EVENT_AFTER_INSERT, [$this, 'send']);
    }

    /**
     * @return array the validation rules.
     */
//    public function rules()
//    {
//        return [
//            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
//            ['email', 'string', 'max' => 100],
//            ['email', 'email'],
//            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('auth', 'EMAIL_HAS_ALREADY_BEEN_TAKEN')],
//
//            ['password', 'required'],
//            ['password', 'string', 'min' => 6, 'max' => 30],
//
//            ['repassword', 'required'],
//            ['repassword', 'string', 'min' => 6, 'max' => 30],
//            ['repassword', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
//
//            ['company', 'filter', 'filter' => 'trim'],
//            ['company', 'required'],
//            ['company', 'string', 'max' => 255],
//
//            ['first_name', 'filter', 'filter' => 'trim'],
//            ['first_name', 'required'],
//            ['first_name', 'string', 'max' => 255],
//
//            ['last_name', 'filter', 'filter' => 'trim'],
//            ['last_name', 'required'],
//            ['last_name', 'string', 'max' => 255],
//
//            ['phone', 'filter', 'filter' => 'trim'],
//            ['phone', 'string', 'max' => 255],
//
//            ['fax', 'filter', 'filter' => 'trim'],
//            ['fax', 'string', 'max' => 255],
//
//            ['legal_address', 'filter', 'filter' => 'trim'],
//            ['legal_address', 'required'],
//            ['legal_address', 'string', 'max' => 255],
//
//            ['postal_address', 'filter', 'filter' => 'trim'],
//            ['postal_address', 'required'],
//            ['postal_address', 'string', 'max' => 255],
//
//            ['krs', 'filter', 'filter' => 'trim'],
//            ['krs', 'required'],
//            ['krs', 'string', 'max' => 255],
//
//            ['acept_legal', 'required'],
//            ['acept_legal', 'required', 'requiredValue' => '1', 'message' => Yii::t('auth', 'NOT_ACEPT_LEGAL') ],
//        ];
//    }

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
//        if(!$this->validate()) {
//            return false;
//        }

        $attr = Yii::$app->request->post();

        $user    = new User(['scenario' => 'signup']);
        $profile = new Profile(['scenario' => 'signup']);

        $user->setAttributes($attr);
        $profile->setAttributes($attr);

        $userValid = $user->validate();
        $profileValid = $profile->validate();

        if($userValid && $profileValid) {
            $user->setProfile($profile);

            if($user->save(false)) {
                Yii::info('User has been registered');
                return true;
            }
        }

        $this->addErrors($user->getErrors());
        $this->addErrors($profile->getErrors());

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
            ->compose('signup', ['model' => $this])
            ->setTo($this->email)
            ->setSubject(Yii::t('auth', 'EMAIL_SUBJECT_SIGNUP'))
            ->send();
    }
}