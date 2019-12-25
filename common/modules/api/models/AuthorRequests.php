<?php

namespace common\modules\api\models;

use Yii;

/**
 * This is the model class for table "author_requests".
 *
 * @property int $id
 * @property string $name
 * @property string $social_instagram
 * @property string $phone
 * @property string $about_me
 * @property int $status
 */
class AuthorRequests extends \yii\db\ActiveRecord
{
//    public $name;
//    public $social_instagram;
//    public $phone;
//    public $about_me;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_me'], 'string'],
            [['status'], 'integer'],
            [['name', 'social_instagram', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'social_instagram' => 'Social Instagram',
            'phone' => 'Phone',
            'about_me' => 'About Me',
            'status' => 'Status',
        ];
    }

    public function create()
    {
        $this->name = Yii::$app->request->post('name') ? Yii::$app->request->post('name') : '';
        $this->social_instagram = Yii::$app->request->post('social_instagram') ? Yii::$app->request->post('social_instagram') : '';
        $this->phone = Yii::$app->request->post('phone') ? Yii::$app->request->post('phone') : '';
        $this->about_me = Yii::$app->request->post('about_me') ? Yii::$app->request->post('about_me') : '';
        $code = Yii::$app->request->post('code') ? Yii::$app->request->post('code') : '';
        $this->status = 0;
        if ($this->phone) {
            $user = AuthorRequests::find()->where(['phone' => $this->phone])->all();
            if (!empty($user)) {
                return ["errors" => [
                    "phone" => "this phone number already has been"
                ]];
            }
        }
        $validCode = [];
        if ($code != '') {
            $validCode = SmsCode::find()->where(['phone' => $this->phone, 'code' => $code])->asArray()->one();
        }
        if (empty($validCode)) {
            return ["errors" => [
                'code' => "invalid code or phone number"
            ]];
        }
        if (!$this->validate()) {
            return null;
        }
        $result = $this->save();
        if ($result) {
            $model = new User();
            $model->username = $this->name;
            $model->phone = $this->phone;
            $model->about_me = $this->about_me;
            $model->firstName = '.';
            $model->lastName = '.';
            $model->nickname = $this->social_instagram;
            $model->status = 9;
            $password = Yii::$app->security->generateRandomString(8);
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);
            if (!$model->save()) {
                return $model->errors;
            } else {
                $userRole = Yii::$app->authManager->getRole('author');
                Yii::$app->authManager->assign($userRole, $model->id);
            }
            $validCode = SmsCode::find()->where(['phone' => $this->phone, 'code' => $code])->one();
            if (!empty($validCode)) {
                $validCode->delete();
            }
            return ["username" => $model->username, "password" => $password];
        }
    }
}
