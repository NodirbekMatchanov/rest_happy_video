<?php

namespace common\modules\api\controllers;

use common\models\User;
use common\models\Video;
use common\modules\api\models\Login;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\UploadedFile;
use common\modules\api\models\SignupForm;

use yii\helpers\Url;
use yii;
use yii\db\Expression;

/**
 * Class UserController
 */
class UserController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => yii\filters\auth\CompositeAuth::className(),
            'except' => ['login', 'sign-up'],
            'authMethods' => [
                yii\filters\auth\HttpBearerAuth::className(),
            ],

        ];

        return $behaviors;
    }

    /**
     * @SWG\Post(path="/api/user/sign-up",
     *     tags={"SignUp"},
     *     summary="Регистрация",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "username",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "firstName",
     *        description = "firstName",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "lastName",
     *        description = "lastName",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "password",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "email",
     *        required = false,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " регистрация ",
     *         @SWG\Schema(ref = "#/definitions/Login")
     *     ),
     * )
     *
     */
    public function actionSignUp()
    {
        $model = new SignupForm();
        if (Yii::$app->request->post() && $user = $model->signup()) {

            return $user;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }
    }

    /**
     * @SWG\Post(path="/api/user/login",
     *     tags={"Login"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "password",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "username",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Авторизация",
     *         @SWG\Schema(ref = "#/definitions/Login")
     *     ),
     * )
     *
     */
    public function actionLogin()
    {
        $model = new Login();
        if (Yii::$app->request->post() && $user = $model->login()) {
            return $user;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }

    }

    /**
     * @SWG\Post(path="/api/user/test-auth",
     *     tags={"Login"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "password",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "username",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Authorization with auth",
     *         @SWG\Schema(ref = "#/definitions/Login")
     *     ),
     * )
     *
     */
    public function actionTestAuth()
    {
        $model = new Login();
        if (Yii::$app->request->post() && $user = $model->login()) {
            return $user;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }

    }

    /**
     * @SWG\Post(path="/api/user/get-by-id",
     *     tags={"User"},
     *    @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     summary="Данные пользователя",
     *     @SWG\Response(
     *         response = 200,
     *         description = "  ",
     *         @SWG\Schema(ref = "#/definitions/User")
     *     ),
     * )
     *
     */
    public function actionGetById()
    {
        $id = Yii::$app->user->getId();
        $model = User::find()->select('id,username,firstName,natification,lastName,email')->where(['id' => $id])->one();
        $video = Video::find()->where(['user_id' => $id])->all();
        $userData = [
            'id' => (int)$model->id,
            'username' => $model->username,
            'firstName' => $model->firstName,
            'lastName' => $model->lastName,
            'email' => $model->email,
            'natification' => (int)$model->natification,
            'video' => [
            ]
        ];
        foreach ($video as $item) {
            $userData['video'][] = [
                'id' => $item->id,
                'link' => $item->link,
                'created_at' => $item->created_at,
                'author_id' => $item->author_id
            ];
        }
        return $userData;
    }

}