<?php

namespace backend\models;

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
 * @property string $access_token
 * @property string $phone
 * @property string $nickname
 * @property string $about_me
 * @property string $video_count
 * @property int $request_in
 * @property string $response_time
 * @property double $order_price
 * @property string $card_number
 * @property int $natification
 * @property int $type
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    public $role;
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
            [['username', 'password'], 'required'],
            [['status', 'type','created_at', 'updated_at', 'request_in', 'natification'], 'integer'],
            [['access_token','about_me'], 'string'],
            [['order_price'], 'number'],
            [['username','role','password_hash', 'password_reset_token', 'email', 'verification_token', 'firstName', 'lastName', 'avatar', 'phone', 'nickname', 'video_count', 'response_time', 'card_number'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
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
            'access_token' => 'Access Token',
            'phone' => 'Phone',
            'nickname' => 'Nickname',
            'about_me' => 'About Me',
            'video_count' => 'Video Count',
            'request_in' => 'Request In',
            'response_time' => 'Response Time',
            'order_price' => 'Order Price',
            'card_number' => 'Card Number',
            'natification' => 'Natification',
        ];
    }
}
