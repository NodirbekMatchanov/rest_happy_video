<?php

namespace common\modules\api\models;

use Yii;
use yii\base\Model;
use common\modules\api\models\User;

/**
 * Login
 */
class Login extends Model
{
    public $username;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username'], 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }


    public function login()
    {
        $this->username = Yii::$app->request->post('username') ? Yii::$app->request->post('username') : '';
        $this->password = Yii::$app->request->post('password') ? Yii::$app->request->post('password') : '';
        if (!$this->validate()) {
            return null;
        }
        $user = User::find()->where(['username' => $this->username])->one();
        if (!empty($user)) {
            if(Yii::$app->security->validatePassword($this->password,$user->password_hash)){
                return $user;
            }
            return [
                'error' => 'invalid password'
            ];

        } else {
            return [
                'error' => 'user not fount'
            ];
        }

    }

}
