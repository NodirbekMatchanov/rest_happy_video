<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author_requests".
 *
 * @property int $id
 * @property string $name
 * @property string $social_instagram
 * @property string $phone
 * @property string $about_me
 * @property int $status
 */
class AuthorRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_me'], 'string'],
            [['status'], 'integer'],
            [['name', 'social_instagram', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'social_instagram' => 'Инстаграмм',
            'phone' => 'Номер телефона',
            'about_me' => 'Расскажите о себе',
            'status' => 'Статус',
        ];
    }
}
