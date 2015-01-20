<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer     $id
 * @property integer     $status_id
 * @property integer     $role_id
 * @property integer     $language
 * @property string      $email
 * @property string      $company
 * @property string      $password_hash
 * @property string      $auth_key
 * @property integer     $created_at
 * @property integer     $updated_at
 *
 * @property string      $status
 *
 * @property Pharmacie[] $pharmacies
 * @property Profile     $profile
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** Статус Не Активный */
    const STATUS_INACTIVE = 0;

    /** Статус Активный */
    const STATUS_ACTIVE = 1;

    /** Статус Забанненый */
    const STATUS_BANNED = 2;

    /** Роль Менеджер */
    const ROLE_USER = 0;

    /** Роль Админ */
    const ROLE_ADMIN = 1;

    /** @var string Пароль в чистом виду. Используется для валидации */
    public $password;

    /**  @var string Читабельный статус пользователя. */
    private $_status;

    /**  @var string Читабельная роль пользователя. */
    private $_roles;

    // *******************************************************************
    // * VALIDATE
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Статус [[status_id]]
            ['status_id', 'in',      'range' => array_keys( self::getStatusArray() )],
            ['status_id', 'default', 'value' => self::STATUS_INACTIVE],

            // Роль [[role_id]]
            ['role_id', 'in',      'range' => array_keys( self::getRoleArray() )],
            ['role_id', 'default', 'value' => self::ROLE_USER],

            ['company', 'required', 'on' => ['signup']],
            ['company', 'string'],

            // Язык [[language]]
            ['language', 'exist',   'targetClass' => Language::className(), 'targetAttribute' => 'url'],
            ['language', 'default', 'value' => Language::getDefaultLang()->url],

            // E-mail [[email]]
            ['email', 'required', 'on' => ['signup', 'create', 'update']],
            ['email', 'trim'],
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            ['email', 'unique'],

            // Пароль [[password]]
            ['password', 'required', 'on' => ['signup', 'create']],
            ['password', 'string', 'min' => 6, 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'recover' => ['password'],
            'signup'  => ['status_id', 'role_id', 'language', 'email', 'company', 'password', 'language'],
            'create'  => ['status_id', 'role_id', 'language', 'email', 'company', 'password', 'language'],
            'update'  => ['status_id', 'role_id', 'language' ,'email', 'company', 'password', 'language'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAttribute('auth_key') == $authKey;
    }

    /**
     * Валидация пароля.
     *
     * @param string $password
     *
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    // *******************************************************************
    // * EVENTS
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('auth_key', Yii::$app->security->generateRandomString());
        }

        if (!empty($this->password)) {
            $this->setAttribute('password_hash', Yii::$app->security->generatePasswordHash($this->password));
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $relatedRecords = $this->getRelatedRecords();

        if ($this->isRelationPopulated('profile')) {
            $this->link('profile', $relatedRecords['profile']);
        }
    }

    // *******************************************************************
    // * RELATIONS
    // *******************************************************************/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @param Profile $profile
     */
    public function setProfile(Profile $profile)
    {
        $this->populateRelation('profile', $profile);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacies()
    {
        return $this->hasMany(Pharmacie::className(), ['user_id' => 'id']);
    }

    /**
     * @param Pharmacie[] $pharmacies
     */
    public function setPharmacies($pharmacies)
    {
        $this->populateRelation('pharmacies', $pharmacies);
    }

    // *******************************************************************
    // * GETTERS
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getAttribute('id');
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->getAttribute('auth_key');
    }

    /**
     * Whether the user is confirmed or not.
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->status_id === self::STATUS_ACTIVE;
    }

    /**
     * Whether the user is banned or not.
     *
     * @return bool
     */
    public function getIsBanned()
    {
        return $this->status_id === self::STATUS_BANNED;
    }

    /**
     * Проверка на показ своего профиля
     *
     * @return bool
     */
    public function getIsOwnProfile()
    {
        return ( ! Yii::$app->user->isGuest and $this->email === Yii::$app->user->identity->email );
    }

    /**
     * Читабельный статус пользователя.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->_status === null)
            ? $this->_status = self::getStatusArray()[$this->status_id]
            : $this->_status;
    }

    /**
     * Читабельная роли пользователя.
     *
     * @return string
     */
    public function getRole()
    {
//        $return = '';
//        $roles = Yii::$app->authManager->getRolesByUser( $this->getId() );
//
//        foreach( $roles as $role) {
//            $return .= $role->name . " \n";
//        }
//
//        return $return;

        return ($this->_roles === null)
            ? $this->_roles = self::getRoleArray()[$this->role_id]
            : $this->_roles;
    }

    /**
     * Массив доступных ролей пользователя.
     *
     * @return array
     */
    public static function getRoleArray()
    {
        return [
            self::ROLE_USER  => Yii::t('user', 'USER'),
            self::ROLE_ADMIN => Yii::t('user', 'ADMIN'),
        ];
    }

    /**
     * Массив доступных статусов пользователя.
     *
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_INACTIVE  => Yii::t('user', 'INACTIVE'),
            self::STATUS_ACTIVE    => Yii::t('user', 'ACTIVE'),
            self::STATUS_BANNED    => Yii::t('user', 'BANNED'),
        ];
    }

    // *******************************************************************
    // * FIND BY
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Выбор пользователя по [[email]]
     *
     * @param string $email
     *
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::find()
            ->where('email = :email', [':email' => $email])
            ->one();
    }

    // *******************************************************************
    // * BASE
    // *******************************************************************/

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('user', 'ID'),
            'status_id'     => Yii::t('user', 'STATUS_ID'),
            'role_id'       => Yii::t('user', 'ROLE_ID'),
            'language'      => Yii::t('user', 'LANGUAGE'),
            'email'         => Yii::t('user', 'EMAIL'),
            'company'       => Yii::t('user', 'COMPANY'),
            'password'      => Yii::t('user', 'PASSWORD'),
            'password_hash' => Yii::t('user', 'PASSWORD_HASH'),
            'auth_key'      => Yii::t('user', 'AUTH_KEY'),
            'created_at'    => Yii::t('user', 'CREATED_AT'),
            'updated_at'    => Yii::t('user', 'UPDATED_AT'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        $fields = parent::fields();

        unset(
            $fields['password_hash'],
            $fields['auth_key'],
            $fields['status_id'],
            $fields['role_id']
        );

        return array_combine($fields, $fields);
    }

    // *******************************************************************
    // * METHODS
    // *******************************************************************/

    public function generateNewPassword()
    {
        $this->password = Yii::$app->security->generateRandomKey(8);

        return $this;
    }
}