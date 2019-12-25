<?php

namespace common\modules\api\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $firstName;
    public $lastName;
    public $password;
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'firstName', 'lastName'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $this->firstName = Yii::$app->request->post('firstName') ? Yii::$app->request->post('firstName') : '';
        $this->lastName = Yii::$app->request->post('lastName') ? Yii::$app->request->post('lastName') : '';
        $this->username = Yii::$app->request->post('username') ? Yii::$app->request->post('username') : '';
        $this->password = Yii::$app->request->post('password') ? Yii::$app->request->post('password') : '';
        $this->email = Yii::$app->request->post('email') ? Yii::$app->request->post('email') : '';
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->setPassword($this->password);
        $user->generateAccessToken();
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if($user->save()){
            $userRole = Yii::$app->authManager->getRole('user');
            Yii::$app->authManager->assign($userRole, $user->id);
            return $user;
        } else {
            return $user->errors;
        }

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
