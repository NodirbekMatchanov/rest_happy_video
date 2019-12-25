<?php

namespace backend\modules\api\definitions;

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
 * @SWG\Property(property="access_token", type="string"),
 * @SWG\Property(property="status", type="integer"),
 * )
 */
