<?php
/**
 * @link http://www.astwellsoft.com/
 * @copyright Copyright (c) 2014 Astwellsoft
 * @license http://www.astwellsoft.com/license/
 */

namespace app\models\form;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer     $id
 * @property string      $email
 * @property integer     $updated_at
 * @property integer     $created_at
 */
class NewsletterForm extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],

            [['updated_at', 'created_at'], 'integer'],

            ['email', 'default', 'value' => Yii::$app->user->identity->email],
        ];
    }

    public static function tableName()
    {
        return '{{%newsletters_users}}';
    }

    public static function findByEmail($email)
    {
        return static::find()
            ->where('email = :email', [':email' => $email])
            ->one();
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('newsletters_form', 'ID'),
            'email'               => Yii::t('newsletters_form', 'YOUR_EMAIL'),
            'updated_at'          => Yii::t('newsletters_form', 'UPDATED_AT'),
            'created_at'          => Yii::t('newsletters_form', 'CREATED_AT'),
        ];
    }
}
