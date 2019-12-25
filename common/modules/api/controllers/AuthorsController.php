<?php

namespace common\modules\api\controllers;

use common\models\User;
use common\modules\api\models\AuthorRequests;
use common\modules\api\models\Login;
use common\modules\api\models\SmsCode;
use common\modules\api\models\SMSRU;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\UploadedFile;
use common\modules\api\models\SignupForm;

use yii\helpers\Url;
use yii;
use yii\db\Expression;

/**
 * Class AuthorsController
 */
class AuthorsController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => yii\filters\auth\CompositeAuth::className(),
            'except' => ['send-request', 'send-code', 'get-list','get-by-id'],
            'authMethods' => [
                yii\filters\auth\HttpBearerAuth::className(),
            ],

        ];

        return $behaviors;
    }

    /**
     * @SWG\Post(path="/api/authors/send-request",
     *     tags={"Authors"},
     *     summary="Запрос на авторство",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "name",
     *        description = "Имя",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "social_instagram",
     *        description = "Инстаграмм",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "phone",
     *        description = "Номер телефона",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "code",
     *        description = "код подтверждения",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "about_me",
     *        description = "Расскажите о себе",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " ответ Запрос на авторство ",
     *         @SWG\Schema(ref = "#/definitions/Authors")
     *     ),
     * )
     *
     */
    public function actionSendRequest()
    {
        $model = new AuthorRequests();
        if (Yii::$app->request->post() && $user = $model->create()) {
            return $user;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }
    }

    /**
     * @SWG\Post(path="/api/authors/send-code",
     *     tags={"Authors"},
     *     summary="Отправка смс код",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "phone",
     *        description = "Номер телефона",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "  ",
     *         @SWG\Schema(ref = "#/definitions/Sms")
     *     ),
     * )
     *
     */
    public function actionSendCode()
    {
        $phone = Yii::$app->request->post('phone') ? Yii::$app->request->post('phone') : '';
        if ($phone != '') {
            $code = rand(1000, 9999);
            $result = $this->sendCode($phone, $code);
            if ($result) {
                $model = new SmsCode();
                $model->phone = $phone;
                $model->code = $code;
                $model->save(false);
            }
            return ($result) ? ["result" => "success"] : ["result" => "error"];
        }
    }

    public function sendCode($phone, $code)
    {
        $smsru = new SMSRU(Yii::$app->params['sms_api']); // Ваш уникальный программный ключ, который можно получить на главной странице

        $data = new \stdClass();
        $data->to = $phone;
        $data->text = 'код:' . $code; // Текст сообщения
        $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

        if ($sms->status == "OK") { // Запрос выполнен успешно
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @SWG\Get(path="/api/authors/get-list",
     *     tags={"Authors"},
     *     summary="Список авторов",
     *     @SWG\Response(
     *         response = 200,
     *         description = "  ",
     *         @SWG\Schema(ref = "#/definitions/Authors")
     *     ),
     * )
     *
     */
    public function actionGetList()
    {
        $authorsList = [];
        $authors = \backend\components\User::getAuthors();
        foreach ($authors as $author) {
            $authorsList[] = [
                'id' => (int)$author['id'],
                'username' => $author['username']
            ];
        }
        return $authorsList;
    }

    /**
     * @SWG\Post(path="/api/authors/get-by-id",
     *     tags={"Authors"},
     *       @SWG\Parameter(
     *        in = "formData",
     *        name = "author_id",
     *        description = "ид автора",
     *        required = true,
     *        type = "string"
     *     ),
     *     summary="Данные автора",
     *     @SWG\Response(
     *         response = 200,
     *         description = "  ",
     *         @SWG\Schema(ref = "#/definitions/GetAuthor")
     *     ),
     * )
     *
     */
    public function actionGetById()
    {
        $id = Yii::$app->request->post('author_id') ? Yii::$app->request->post('author_id') : null;
        if (!$id) {
            Yii::$app->response->statusCode = 400;
            return ['errors' => [
                'id' => 'does not required param'
            ]];
        }
        $model = User::find()->select('id,username,firstName,lastName,nickname,phone,video_count,request_in,response_time,about_me,order_price,card_number')->where(['id' => $id])->one();
        return $model;
    }


}