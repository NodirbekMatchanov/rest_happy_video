<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sms_code}}`.
 */
class m191119_180740_create_sms_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sms_code}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(),
            'code' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sms_code}}');
    }
}
