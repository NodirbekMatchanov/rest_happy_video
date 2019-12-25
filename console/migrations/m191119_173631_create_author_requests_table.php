<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_requests}}`.
 */
class m191119_173631_create_author_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_requests}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'social_instagram' => $this->string(),
            'phone' => $this->string(),
            'about_me' => $this->text(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_requests}}');
    }
}
