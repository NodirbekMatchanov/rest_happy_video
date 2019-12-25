<?php

namespace backend\modules\api\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\UploadedFile;

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


    }

    /**
     * @SWG\Post(path="/backend/web/api/user/login",
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
     *        name = "email",
     *        description = "email",
     *        required = true,
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
    public function actionLogin()
    {
        $email = Yii::$app->request->post('email') ? Yii::$app->request->post('email') : null;
        $password = Yii::$app->request->post('password') ? Yii::$app->request->post('password') : null;
        if ($password == '' || $email == '') {
            Yii::$app->response->statusCode = 400;
            return [
                'error' => 'Bad request',
                'code' => '400'
            ];

        }

    }


}