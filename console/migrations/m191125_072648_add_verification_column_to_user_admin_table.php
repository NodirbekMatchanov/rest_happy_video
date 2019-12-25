<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_admin}}`.
 */
class m191125_072648_add_verification_column_to_user_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_admin}}', 'verification_token', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_admin}}', 'verification_token');
    }
}
