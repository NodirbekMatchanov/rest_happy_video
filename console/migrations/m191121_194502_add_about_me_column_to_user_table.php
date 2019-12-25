<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m191121_194502_add_about_me_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'video_count', $this->string());
        $this->addColumn('{{%user}}', 'request_in', $this->integer());
        $this->addColumn('{{%user}}', 'response_time', $this->string());
        $this->addColumn('{{%user}}', 'order_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'video_count');
        $this->dropColumn('{{%user}}', 'request_in');
        $this->dropColumn('{{%user}}', 'response_time');
        $this->dropColumn('{{%user}}', 'order_price');
    }
}
