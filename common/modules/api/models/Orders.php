<?php

namespace common\modules\api\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property int $video_to
 * @property int $category_id
 * @property string $description
 * @property string $author_id
 * @property string $email
 * @property string $user_id
 * @property integer $status
 * @property string $link
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_to', 'name', 'email', 'author_id', 'category_id'], 'required'],
            [['video_to', 'status', 'author_id', 'category_id'], 'integer'],
            [['description', 'link'], 'string'],
            [['name', 'user_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'video_to' => 'Video To',
            'category_id' => 'Category ID',
            'description' => 'Description',
        ];
    }

    public function create()
    {
        $this->name = Yii::$app->request->post('name') ? Yii::$app->request->post('name') : '';
        $this->video_to = Yii::$app->request->post('video_to') ? Yii::$app->request->post('video_to') : '';
        $this->category_id = Yii::$app->request->post('category') ? Yii::$app->request->post('category') : '';
        $this->description = Yii::$app->request->post('description') ? Yii::$app->request->post('description') : '';
        $this->author_id = Yii::$app->request->post('author_id') ? Yii::$app->request->post('author_id') : '';
        $this->email = Yii::$app->request->post('email') ? Yii::$app->request->post('email') : '';
        $this->user_id = Yii::$app->request->post('user_id') ? Yii::$app->request->post('user_id') : '';
        $this->status = 0;
        $author = User::findOne($this->author_id);
        if (empty($author)) {
            return ['errors' => [
                'author_id' => 'does not found author'
            ]];
        }
        if (!$this->validate()) {
            return $this->errors;
        }
        if (!$this->save()) {
            return $this->errors;
        } else {
            return $this;
        }
    }

    public function updateOrder()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : null;
        $model = Orders::findOne($id);
        if (!empty($model)) {
            $model->name = Yii::$app->request->post('name') ? Yii::$app->request->post('name') : $model->name;
            $model->video_to = Yii::$app->request->post('video_to') ? Yii::$app->request->post('video_to') : $model->video_to;
            $model->category_id = Yii::$app->request->post('category_id') ? Yii::$app->request->post('category_id') : $model->category_id;
            $model->description = Yii::$app->request->post('description') ? Yii::$app->request->post('description') : $model->description;
            $model->author_id = Yii::$app->request->post('author_id') ? Yii::$app->request->post('author_id') : $model->author_id;
            $model->email = Yii::$app->request->post('email') ? Yii::$app->request->post('email') : $model->email;
        }
        $author = User::findOne($this->author_id);
        if (empty($author) && Yii::$app->request->post('author_id')) {
            return ['errors' => [
                'author_id' => 'does not found author'
            ]];
        }
        if (!$model->update(false)) {
            return $this->errors;
        } else {
            return ['result' => 'success'];
        }
    }

    public function getOrders()
    {
        $id = Yii::$app->user->getId();
        $model = Orders::find()->where(['author_id' => $id])->all();
        return $model;
    }

    public function addLink()
    {
        $id = Yii::$app->request->post('order_id') ? Yii::$app->request->post('order_id') : null;
        $link = Yii::$app->request->post('link') ? Yii::$app->request->post('link') : null;
        $model = Orders::find()->where(['id' => $id, 'author_id' => Yii::$app->user->getId()])->one();
        if (empty($model)) {
            return ['errors' => [
                'order_id' => 'does not found order'
            ]];
        }
        $model->link = $link;
        $model->status = 2;
        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }
}
