<?php

namespace common\modules\api\models;

use Yii;

/**
 * This is the model class for table "sms_code".
 *
 * @property int $id
 * @property string $phone
 * @property string $code
 */
class SmsCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'code' => 'Code',
        ];
    }
}
