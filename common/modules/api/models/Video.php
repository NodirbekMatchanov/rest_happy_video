<?php

namespace common\modules\api\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $link
 * @property int $user_id
 * @property int $author_id
 * @property string $created_at
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link'], 'string'],
            [['user_id', 'author_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'user_id' => 'User ID',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
        ];
    }
}
