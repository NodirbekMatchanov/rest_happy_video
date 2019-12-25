<?php

namespace common\modules\api\controllers;

use common\models\Category;
use common\models\User;
use common\modules\api\models\AuthorRequests;
use common\modules\api\models\Login;
use common\modules\api\models\Orders;
use common\modules\api\models\SmsCode;
use common\modules\api\models\SMSRU;
use common\modules\api\models\Video;
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
class OrdersController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => yii\filters\auth\CompositeAuth::className(),
            'except' => ['order-video', 'send-code', 'get-category-list', 'get-orders'],
            'authMethods' => [
                yii\filters\auth\HttpBearerAuth::className(),
            ],

        ];

        return $behaviors;
    }

    /**
     * @SWG\Post(path="/api/orders/order-video",
     *     tags={"Orders"},
     *     summary="Заказы",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "name",
     *        description = "Имя",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "video_to",
     *        description = "Кому видео(для заказчика, для другого)",
     *        required = true,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "category",
     *        description = "Категория ",
     *        required = true,
     *        type = "integer"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "description",
     *        description = "Описание",
     *        required = false,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "author_id",
     *        description = "автор",
     *        required = true,
     *        type = "integer"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "Почта для уведомления",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "user_id",
     *        description = "ид",
     *        required = false,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */
    public function actionOrderVideo()
    {
        $model = new Orders();
        if (Yii::$app->request->post() && $request = $model->create()) {
            return $request;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }
    }

    /**
     * @SWG\Post(path="/api/orders/update",
     *     tags={"Orders"},
     *     summary="Обнавить заказ",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "id",
     *        description = "ид",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "name",
     *        description = "Имя",
     *        required = false,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "video_to",
     *        description = "Кому видео(для заказчика, для другого)",
     *        required = false,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "category",
     *        description = "Категория ",
     *        required = false,
     *        type = "integer"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "description",
     *        description = "Описание",
     *        required = false,
     *        type = "string"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "author_id",
     *        description = "автор",
     *        required = false,
     *        type = "integer"
     *     ),
     *   @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "Почта для уведомления",
     *        required = false,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */
    public function actionUpdate()
    {
        $model = new Orders();
        if (Yii::$app->request->post() && $request = $model->updateOrder()) {
            return $request;
        } else {
            $errorList = [];
            $errorList['errors'] = $model->errors;
            Yii::$app->response->statusCode = 400;
            return $errorList;
        }
    }
    /**
     * @SWG\Post(path="/api/orders/add-video",
     *     tags={"Orders"},
     *     summary="добавить видео",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "order_id",
     *        description = "ид заказа",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *        in = "formData",
     *        name = "link",
     *        description = "ссылка на видео",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */
    public function actionAddVideo()
    {
        if(Yii::$app->request->post()){
            $model = new Orders();
            return $model->addLink();
        }
    }

    /**
     * @SWG\Post(path="/api/orders/get-by-id",
     *     tags={"Orders"},
     *     summary="Получить по ид",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "id",
     *        description = "ид",
     *        required = true,
     *        type = "string"
     *     ),
     *    @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */
    public function actionGetById()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : null;
        if (Yii::$app->request->post()) {
            $model = Orders::findOne($id);
            if (!empty($model)) {
                return $model;
            } else {
                return [
                    'result' => 'not found'
                ];
            }
        } else {
            Yii::$app->response->statusCode = 400;
            return ['errors' => [
                'id' => 'id required'
            ]];
        }
    }
    /**
     * @SWG\Delete(path="/api/orders/delete-by-id",
     *     tags={"Orders"},
     *     summary="удалить по ид",
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "id",
     *        description = "ид",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */
    public function actionDeleteById()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : null;
        if (Yii::$app->request->post()) {
            $model = Orders::findOne($id);
            if (!empty($model)) {
                return $model->delete();
            } else {
                return [
                    'result' => 'not found'
                ];
            }
        } else {
            Yii::$app->response->statusCode = 400;
            return ['errors' => [
                'id' => 'id required'
            ]];
        }
    }

    /**
     * @SWG\Get(path="/api/orders/get-category-list",
     *     tags={"Orders"},
     *     summary="Категории",
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Category")
     *     ),
     * )
     *
     */

    public function actionGetCategoryList()
    {
        return Category::find()->all();
    }

    /**
     * @SWG\Get(path="/api/orders/get-orders",
     *     tags={"Orders"},
     *     summary="Cписок заказов",
     *     @SWG\Parameter(
     *      type="string",
     *      name="Authorization",
     *      in="header",
     *     description = "example: Bearer 'access_token' ",
     *      required=true),
     *     @SWG\Response(
     *         response = 200,
     *         description = "ответ",
     *         @SWG\Schema(ref = "#/definitions/Orders")
     *     ),
     * )
     *
     */

    public function actionGetOrders()
    {
        $model = new Orders();
        return $model->getOrders();
    }


}