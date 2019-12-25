<?php

namespace common\modules\api\definitions;

use common\models\User;
use Yii;
use yii\base\Model;


/**
 * @SWG\Definition(
 *   definition="Orders",
 *   required={"name","video_to","description","category","author_id","email"},
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="video_to", type="integer"),
 * @SWG\Property(property="category", type="integer"),
 * @SWG\Property(property="author_id", type="integer"),
 * @SWG\Property(property="description", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="link", type="string"),
 * )
 */
/**
 * @SWG\Definition(
 *   definition="Category",
 *   required={"name"},
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * )
 */
