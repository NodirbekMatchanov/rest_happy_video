<?php

namespace common\modules\api\definitions;

use common\models\User;
use Yii;
use yii\base\Model;


/**
 * @SWG\Definition(
 *   definition="Authors",
 *   required={"name","social_instagram","phone","about_me"},
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="social_instagram", type="string"),
 * @SWG\Property(property="phone", type="string"),
 * @SWG\Property(property="about_me", type="string"),
 * @SWG\Property(property="status", type="integer"),
 * )
 */
/**
 * @SWG\Definition(
 *   definition="GetAuthor",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="username", type="string"),
 * @SWG\Property(property="firstName", type="string"),
 * @SWG\Property(property="lastName", type="string"),
 * @SWG\Property(property="nickname", type="string"),
 * @SWG\Property(property="phone", type="string"),
 * @SWG\Property(property="about_me", type="string"),
 * @SWG\Property(property="video_count", type="string"),
 * @SWG\Property(property="request_in", type="integer"),
 * @SWG\Property(property="response_time", type="string"),
 * @SWG\Property(property="order_price", type="number"),
 * @SWG\Property(property="card_number", type="string"),
 * )
 */
/**
 * @SWG\Definition(
 *   definition="Sms",
 *   required={"phone"},
 * @SWG\Property(property="phone", type="string"),
 * )
 */
