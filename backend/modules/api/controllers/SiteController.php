<?php

namespace backend\modules\api\controllers;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;


class SiteController extends Controller
{
  
    /**
     * @SWG\Swagger(
     *     schemes={"http","https"},
     
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="Rest API",
     *         description="Unwayl Rest Api ",
     *         termsOfService="http://swagger.io/terms/",
   
     *     ),
     *     @SWG\ExternalDocumentation(
     *         description="Find out more about Swagger",
     *         url="http://swagger.io"
     *     )
     * )
     */
    /**
     * @inheritdoc
     */
    public function actions(): array 
    {

        return [
            'docs' => [
                'class' => 'yii2mod\swagger\SwaggerUIRenderer',
                'restUrl' => Url::to(['site/json-schema']),
            ],

            'json-schema' => [
                'class' => 'yii2mod\swagger\OpenAPIRenderer',
//                'class' => 'light\swagger\SwaggerApiAction',

                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@backend/models'),
                    Yii::getAlias('@backend/modules/api/definitions'),
                    Yii::getAlias('@backend/modules/api/controllers'),
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
