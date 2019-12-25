<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m191117_184443_add_custom_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'firstName', $this->string());
        $this->addColumn('{{%user}}', 'lastName', $this->string());
        $this->addColumn('{{%user}}', 'avatar', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'firstName');
        $this->dropColumn('{{%user}}', 'lastName');
        $this->dropColumn('{{%user}}', 'avatar');
    }
}
