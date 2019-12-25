<?php

namespace common\modules\api\controllers;
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
     *         version="1.1.0",
     *         title="Rest API",
     *         description=" Rest Api ",
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
                    Yii::getAlias('@common/models'),
                    Yii::getAlias('@common/modules/api/definitions'),
                    Yii::getAlias('@common/modules/api/controllers'),
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
