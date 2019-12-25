<?php

namespace common\modules\api\definitions;

use common\models\User;
use Yii;
use yii\base\Model;


/**
 * @SWG\Definition(
 *   definition="Login",
 *   required={"password"},
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="firstName", type="string"),
 * @SWG\Property(property="lastName", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="username", type="string"),
 * @SWG\Property(property="auth_key", type="string"),
 * @SWG\Property(property="status", type="integer"),
 * @SWG\Property(property="created_at", type="integer"),
 * @SWG\Property(property="updated_at", type="integer"),
 * )
 */
/**
 * @SWG\Definition(
 *   definition="User",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="firstName", type="string"),
 * @SWG\Property(property="lastName", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="username", type="string"),
 * @SWG\Property(property="natification", type="integer"),
 * @SWG\Property(property="video", type="array", @SWG\Items(type="object",
 *              @SWG\Property(property="id",type="integer"),
 *              @SWG\Property(property="link",type="string"),
 *              @SWG\Property(property="created_at",type="string"),
 *              @SWG\Property(property="aurhor_id",type="integer")  ), description=""),
 * )
 */
