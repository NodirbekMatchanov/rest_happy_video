<?php

namespace common\modules\api\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property string $firstName
 * @property string $lastName
 * @property string $avatar
 * @property string $phone
 * @property string $nickname
 * @property string $about_me
 * @property string $video_count
 * @property string $response_time
 * @property integer $request_in
 * @property string $card_number
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'firstName', 'lastName'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username','card_number','phone','response_time','video_count','nickname','password_hash', 'password_reset_token', 'email', 'verification_token', 'firstName', 'lastName', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['about_me'], 'string'],
            [['username'], 'unique'],
            [['request_in'], 'integer'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'avatar' => 'Avatar',
        ];
    }
}
