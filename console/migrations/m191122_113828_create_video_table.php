<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m191122_113828_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'link' => $this->text(),
            'user_id' => $this->integer(),
            'author_id' => $this->integer(),
            'created_at' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
